<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.components.actions.api.ApiDataProvider');
Yii::import('common.modules.plans.actions.ApiSubscribeAction');
Yii::import('common.modules.plans.actions.ApiUnsubscribeAction');
Yii::import('plans.controllers.PlansControllerTrait');
/**
 * Description of ManagementController
 *
 * @author kwlok
 */
class ManagementController extends SPageIndexController
{
    use PlansControllerTrait;
    /**
     * Init class
     */
    public function init()
    {
        parent::init();
        //-----------------
        // SPageIndex Configuration
        // @see SPageIndexController
        $this->modelType = 'Plan';
        $this->viewName = Sii::t('sii','Plans');
        $this->route = 'plans/management/index';
        //$this->pageViewOption = SPageIndex::VIEW_GRID;
        $this->sortAttribute = 'create_time';
        //-----------------//
        // PlansControllerTrait Configuration
        $this->submitUrl = 'plans/management/submit';
        $this->apiRoute = '/plans';    
        //-----------------//
        $this->rightsFilterActionsExclude = [
            'prepareIndex',
        ];
    }
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array_merge(parent::actions(),[
            'prepareIndex'=>[
                'class'=>'common.components.actions.api.ApiIndexAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'afterIndex'=>'prepareDataProvider',
            ],            
            'view'=>[
                'class'=>'common.components.actions.api.ApiReadAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'childAttributes'=>['items'],
            ],                    
            'create'=>[
                'class'=>'common.components.actions.api.ApiCreateAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'setAttributesMethod'=>'setModelAttributes',
            ],
            'update'=>[
                'class'=>'common.components.actions.api.ApiUpdateAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'childAttributes'=>['items'],
                'beforeRender'=>'prepareItemsData',
                'setAttributesMethod'=>'setModelAttributes',
            ], 
            'delete'=>[
                'class'=>'common.components.actions.api.ApiDeleteAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
            ],
            'submit'=>[
                'class'=>'common.components.actions.api.ApiTransitionAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'transitionAction'=>'submit',
                'flashTitle'=>Sii::t('sii','Plan Submission'),
                'flashMessage'=>Sii::t('sii','"{name}" is submitted successfully.'),
            ],
        ]);
    }
    /**
     * Subscribe a plan
     */
    public function actionSubscribe($plan)
    {
        $model = $this->loadModel($plan);
        
        if (isset($_POST['subscriber']) && $_POST['subscriber']!=Account::GUEST){
            try {
                
                $action = new ApiSubscribeAction($this,__METHOD__,$model->id,$_POST['subscriber']);
                $action->postFields = json_encode([
                    'shop'=>null,
                    'package'=>$model->packageModel->id,
                    'paymentNonce'=> rand(0, 1000),//pass in dummy paymentNonce since this is mandatory field
                ]);
                $action->afterSubscribe = 'subscribeOK';
                $this->runAction($action);  
                unset($_POST);//unset $_POST first to avoid multiple subscriptions if too many POST sent from browser
                Yii::app()->end();
                
            } catch (CException $ex) {
                $this->unsubscribeError($ex->getMessage(), $ex->getTraceAsString());
            }
            
        }
        
        if ($model->isInternal)
            $this->render('subscribe',['model'=>$model]);
        else
            throwError403(Sii::t('sii','Unauthorized Action'));
    }      
    /**
     * Gather the successful subscription returned from API 
     */
    public function subscribeOK($subscription)
    {
        user()->setFlash($this->modelType,[
            'message'=>null,
            'type'=>'success',
            'title'=>Sii::t('sii','User "{subscriber}" is subscribed to Package "{package}" and Plan "{plan}" successfully.',[
                            '{subscriber}'=>$subscription['account_id'],
                            '{plan}'=>$subscription['plan']['id'],
                            '{package}'=>$subscription['package'],
                        ]),
        ]);
        $this->redirect(url('plans/management/view/'.$subscription['plan']['id']));
    }    
    /**
     * Unsubcribe a plan
     */
    public function actionUnsubscribe($id,$subNo,$planId)
    {
        $subscription = $this->loadModel($id,'Subscription');
         
        if ($subscription!=null && $subscription->subscription_no == $subNo && $subscription->plan_id == $planId){

            try {
                //Note: $subscription->shop = null;//for admin user subscription, there is no need to have shop
                $action = new ApiUnsubscribeAction($this,__METHOD__,$subscription->subscription_no,$subscription->shop,$subscription->package_id,$subscription->plan_id,$subscription->account_id);
                $action->afterUnsubscribe = 'unsubscribeOK';
                $this->runAction($action);  
                Yii::app()->end();
                
            } catch (CException $ex) {
                $this->unsubscribeError($ex->getMessage(), $ex->getTraceAsString());
            }
        }
        else
            $this->unsubscribeError(__METHOD__.' Subscription ID '.$id.' not found!');
        
    }     
    /**
     * Gather the successful unsubscription returned from API
     * @param $params The callback return data; @see ApiUnsubscribeAction::getReturnModel() for data structure
     */
    public function unsubscribeOK($params)
    {
        user()->setFlash($this->modelType,[
            'message'=>null,
            'type'=>'success',
            'title'=>Sii::t('sii','User "{subscriber}" is unsubscribed from Plan "{plan}" successfully.',[
                            '{subscriber}'=>$params['subscriber'],
                            '{plan}'=>$params['plan_id'],
                        ]),
        ]);
        $this->redirect(url('plans/management/view/'.$params['plan_id']));
    }    
    /**
     * Gather the unsuccessful unsubscription message
     */
    public function unsubscribeError($errorMessage,$errorStackTrace=null)
    {
        logError(__METHOD__.' Error '.$errorMessage,$errorStackTrace);
        user()->setFlash($this->modelType,[
            'message'=>$errorMessage,
            'type'=>'error',
            'title'=>Sii::t('sii','Plan Unsubscribe Error'),
        ]);
        $this->redirect(url('plans/management/index'));
    }     
    /**
     * Set model attributes for create/update action
     * @param type $model
     * @return type
     */
    public function setModelAttributes($model)
    {
        if(isset($_POST[$this->modelType])) {
            $model->attributes = $_POST[$this->modelType];
            if (!isset($_POST[$this->modelType]['items']))
                $model->items = '';//no items specified
            
            if (is_array($model->items)){
                $items = new CList();
                foreach ($_POST[$this->modelType]['items'] as $item) {
                    $items->add(['name'=>$item]);
                }
                $model->items = $items->toArray();
            }
            return $model;
        }
        throwError400(Sii::t('sii','Bad Request'));
    }     
    /**
     * Return section data
     * @param type $model
     * @return type
     */
    public function getSectionsData($model) 
    {
        $sections = new CList();
        //section 1: Plan Items
        if ($model->hasItems){
            $dataProvider = new CArrayDataProvider($this->parseItems($model),[
                                'pagination'=>[
                                    'pageSize'=>1000,//need to set to higher value to have all items in one page
                                    'currentPage'=>0,//page 1
                                ]
                            ]);
            $sections->add([
                'id'=>'planitem','name'=>Sii::t('sii','Plan Items'),'heading'=>true,
                'viewFile'=>$this->module->getView('plans.planitemview'),
                'viewData'=>['dataProvider'=>$dataProvider]
            ]);//data is coming from api
        }
        
        if ($this->action->id!='subscribe'){
            //section 2: Process History
            $sections->add([
                    'id'=>'history','name'=>Sii::t('sii','Process History'),'heading'=>true,
                    'viewFile'=>$this->module->getView('history'),
                    'viewData'=>['dataProvider'=>$model->searchTransition($model->id)]
                ]);
            if ($model->isInternal){//show subscriber for internal plan only
                //section 3: Show subscribers list
                $sections->add([
                        'id'=>'history','name'=>Sii::t('sii','Subscribers'),'heading'=>true,
                        'viewFile'=>$this->module->getView('plans.subscriberview'),
                        'viewData'=>['dataProvider'=>$model->searchSubscribers()]
                    ]);
            }
            
        }
        
        return $sections->toArray();
    }
    /**
     * Resolve items into feature data (used in form view)
     * @param type $model
     */
    protected function parseItems($model)
    {
        $items = [];
        foreach ($model->items as $item) {
            $data = [];
            foreach ($item as $key => $value) {
                if ($key=='name'){
                    $featureData = explode(Feature::KEY_SEPARATOR,$value);
                    $data['featureId'] = $featureData[0];
                    $data['featureName'] = Feature::getNameDesc($featureData[1]);
                    $data['featureGroup'] = Feature::siiGroup()[$featureData[2]];
                }
                else 
                    $data[$key] = $value;
            }
            $items[] = $data;
        }
        logTrace(__METHOD__,$items);
        return $items;
    }
    /**
     * Prepare items data to load form view
     * @param type $model
     */
    public function prepareItemsData($model) 
    {
        $names = [];
        foreach ($model->items as $item) {
            foreach ($item as $key => $value) {
                if ($key=='name')
                    $names[] = $value;
            }
        }
        $model->items = $names;
        logTrace(__METHOD__.' model items',$model->items);
        return $model;
    }
    /**
     * Get admin users (exludes those already subcribed to the plan)
     * @param CModel $planModel Plan model
     */
    public function getAdminUsersArray($planModel)
    {
        $candidates = [
            Account::GUEST => Sii::t('sii','Select account to subscribe to this plan'),
        ];
        foreach (Account::model()->admin()->findAll() as $user) {
            $candidates[$user->id] = $user->name.' ('.$user->id.')';
        }
            
        $subcriptions = $planModel->searchSubscribers()->data;
        foreach ($subcriptions as $subscription) {
            if ($subscription->isActive && isset($candidates[$subscription->account_id]))
                unset($candidates[$subscription->account_id]);//remove existing subscriber
        }
        
        return $candidates;
    }
}
