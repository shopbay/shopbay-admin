<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.components.actions.api.ApiDataProvider');
Yii::import('plans.controllers.PlansControllerTrait');
/**
 * Description of PackageController
 *
 * @author kwlok
 */
class PackageController extends SPageIndexController
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
        $this->modelType = 'Package';
        $this->viewName = Sii::t('sii','Packages');
        $this->route = 'plans/package/index';
        //$this->pageViewOption = SPageIndex::VIEW_GRID;
        $this->sortAttribute = 'create_time';
        //-----------------//
        // PlansControllerTrait Configuration
        $this->submitUrl = 'plans/package/submit';
        $this->apiRoute = '/packages';    
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
                'beforeRender'=>'preparePlansData',
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
                'flashTitle'=>Sii::t('sii','Package Submission'),
                'flashMessage'=>Sii::t('sii','"{name}" is submitted successfully.'),
            ],
        ]);
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
            if (!isset($_POST[$this->modelType]['plans']))
                $model->plans = null;//no plans selected 
            if (is_array($model->plans)){
                $model->plans = implode(Package::PLAN_SEPARATOR, $model->plans);
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
    public function getSectionsData($model,$workflowView=false) 
    {
        $sections = new CList();
        //section 1: Plans
        if ($model->hasPlans){
            if ($workflowView){
                $sections->add(['id'=>'planitem','name'=>Sii::t('sii','Plans'),'heading'=>true,
                        'viewFile'=>$this->module->getView('plans.planworkflowview'),'viewData'=>['dataProvider'=>$model->searchPlans()]]);
            }
            else
                $sections->add(['id'=>'planitem','name'=>Sii::t('sii','Plans'),'heading'=>true,
                        'viewFile'=>$this->module->getView('plans.plangridview'),'viewData'=>['dataProvider'=>new CArrayDataProvider($model->plans)]]);//data is coming from api
        }
        //section 2: Process History
        $sections->add(['id'=>'history','name'=>Sii::t('sii','Process History'),'heading'=>true,
                             'viewFile'=>$this->module->getView('history'),'viewData'=>['dataProvider'=>$model->searchTransition($model->id)]]);
        return $sections->toArray();
    }         
    /**
     * Prepare plans data to load form view
     * @param type $model
     */
    public function preparePlansData($model) 
    {
        $plans = [];
        foreach ($model->plans as $plan) {
            $plans[] = $plan['id'];
        }
        $model->plans = $plans;
        logTrace(__METHOD__.' model plans',$model->plans);
        return $model;
    }

    private $_approvedPlans = [];
    public function getApprovedPlans()
    {
        if (empty($this->_approvedPlans)){
            Yii::import('common.components.actions.api.ApiDataProvider');
            Yii::import('common.components.actions.api.ApiIndexAction');
            $action = new ApiIndexAction($this,__METHOD__);
            $action->user = Account::SYSTEM;
            $action->model = 'Plan';
            $action->apiRoute = '/plans/published';
            $action->retryAccessToken = true;
            $action->afterIndex = 'preparePlanDataProvider';
            $this->runAction($action);     
        }
        return $this->_approvedPlans;
    }
    /**
     * Prepare data provider (a call back from ApiIndexAction)
     * @see common.components.actions.api.ApiIndexAction
     * @param type $items
     * @param type $pagination
     * @param type $links
     */
    public function preparePlanDataProvider($items, $pagination, $links)
    {
        foreach ($items as $item) {//not using ApiDataProvider, and presume less than one page
            $this->_approvedPlans[$item->id] = $item->name;
        }
    }       
}
