<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of ManagementController
 *
 * @author kwlok
 */
class ManagementController extends SPageIndexController
{
    protected $formType = 'TagForm';
    
    public function init()
    {
        parent::init();
        //-----------------
        // SPageIndex Configuration
        // @see SPageIndexController
        $this->modelType = 'Tag';
        $this->viewName = Sii::t('sii','Tags');
        $this->route = 'tags/management/index';
        //$this->pageViewOption = SPageIndex::VIEW_GRID;
        $this->sortAttribute = 'update_time';
        //-----------------//
    }
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array_merge(parent::actions(),[
            'view'=>[
                'class'=>'common.components.actions.ReadAction',
                'model'=>$this->modelType,
            ],                    
            'create'=>[
                'class'=>'common.components.actions.LanguageCreateAction',
                'form'=>$this->formType,
                'createModelMethod'=>'prepareForm',
                'setModelAttributesMethod'=>'setModelAttributes',
            ],
            'update'=>[
                'class'=>'common.components.actions.LanguageUpdateAction',
                'form'=>$this->formType,
                'loadModelMethod'=>'prepareForm',
                'setModelAttributesMethod'=>'setModelAttributes',
            ], 
            'delete'=>[
                'class'=>'common.components.actions.DeleteAction',
                'model'=>$this->modelType,
            ],
        ]);
    }  
    
    public function prepareForm($id=null)
    {
        if (isset($id)){//update action
            $form = new $this->formType($id, 'update');
            $form->loadLocaleAttributes();
        }
        else {
            $form = new $this->formType(Helper::NULL);
        }
        return $form;
    }    

    public function setModelAttributes($form)
    {
        //[1]copy form attributes to model attributes
        $form->modelInstance->attributes = $form->getAttributes();
        
        return $form;
    }    
    /**
     * Return page menu (with auto active class)
     * @param type $model
     * @return type
     */
    public function getPageMenu($model)
    {
        return [
            ['id'=>'view','title'=>Sii::t('sii','View {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','view'),  'url'=>$model->viewUrl,'linkOptions'=>['class'=>$this->action->id=='view'?'active':'']],
            ['id'=>'create','title'=>Sii::t('sii','Create {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','create'), 'url'=>['create']],
            ['id'=>'update','title'=>Sii::t('sii','Update {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','update'), 'url'=>['update', 'id'=>$model->id],'visible'=>$model->updatable(),'linkOptions'=>['class'=>$this->action->id=='update'?'active':'']],
            ['id'=>'delete','title'=>Sii::t('sii','Delete {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','delete'), 'visible'=>$model->deletable(), 
                'linkOptions'=>[
                    'submit'=>['delete','id'=>$model->id],
                    'onclick'=>'$(\'.page-loader\').show();',
                    'confirm'=>Sii::t('sii','Are you sure you want to delete this {object}?',['{object}'=>strtolower($model->displayName())]),
                ],
            ],
        ];
    }
    /**
     * OVERRIDE METHOD
     * @see SPageIndexController
     * @return array
     */
    public function getScopeFilters()
    {
        $filters = new CMap();
        $filters->add('all',Helper::htmlIndexFilter('All', false));
        return $filters->toArray();
    }    
        
}
