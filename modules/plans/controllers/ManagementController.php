<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.components.actions.api.ApiDataProvider');
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
        return array_merge(parent::actions(),array(
            'prepareIndex'=>array(
                'class'=>'common.components.actions.api.ApiIndexAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'afterIndex'=>'prepareDataProvider',
            ),            
            'view'=>array(
                'class'=>'common.components.actions.api.ApiReadAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'childAttributes'=>['items'],
            ),                    
            'create'=>array(
                'class'=>'common.components.actions.api.ApiCreateAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'setAttributesMethod'=>'setModelAttributes',
            ),
            'update'=>array(
                'class'=>'common.components.actions.api.ApiUpdateAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'childAttributes'=>['items'],
                'beforeRender'=>'prepareItemsData',
                'setAttributesMethod'=>'setModelAttributes',
            ), 
            'delete'=>array(
                'class'=>'common.components.actions.api.ApiDeleteAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
            ),
            'submit'=>array(
                'class'=>'common.components.actions.api.ApiTransitionAction',
                'apiRoute'=>$this->apiRoute,
                'model'=>$this->modelType,
                'transitionAction'=>'submit',
                'flashTitle'=>Sii::t('sii','Plan Submission'),
                'flashMessage'=>Sii::t('sii','"{name}" is submitted successfully.'),
            ),
        ));
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
            $dataProvider = new CArrayDataProvider($this->parseItems($model),array(
                    'pagination'=>array(
                        'pageSize'=>1000,//need to set to higher value to have all items in one page
                        'currentPage'=>0,//page 1
            )));
            $sections->add(array('id'=>'planitem','name'=>Sii::t('sii','Plan Items'),'heading'=>true,
                        'viewFile'=>$this->getModule()->getView('plans.planitemview'),'viewData'=>array('dataProvider'=>$dataProvider)));//data is coming from api
        }
        //section 2: Process History
        $sections->add(array('id'=>'history','name'=>Sii::t('sii','Process History'),'heading'=>true,
                             'viewFile'=>$this->getModule()->getView('history'),'viewData'=>array('dataProvider'=>$model->searchTransition($model->id))));
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
}
