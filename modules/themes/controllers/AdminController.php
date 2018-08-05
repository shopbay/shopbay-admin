<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.modules.tasks.components.TransitionControllerActionTrait');
/**
 * Description of AdminController
 *
 * @author kwlok
 */
class AdminController extends SPageIndexController
{
    use TransitionControllerActionTrait;
    
    protected $formType = 'ThemeForm';           
    
    public function init()
    {
        parent::init();
        //-----------------
        // SPageIndex Configuration
        // @see SPageIndexController
        $this->modelType = 'Theme';
        $this->modelFilter = 'all';
        $this->viewName = Sii::t('sii','Themes');
        $this->route = 'themes/admin/index';
        //$this->pageViewOption = SPageIndex::VIEW_GRID;
        $this->sortAttribute = 'update_time';
        //-----------------//
    }
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        $this->transitionCheckAccess = false;//Theme admin does not check creator
        $this->transitionModelFilter = null;//set model filter to null - as theme admin does not check creator
        return array_merge(parent::actions(),$this->transitionActions(false,true),[
            'create'=>[
                'class'=>'common.components.actions.LanguageCreateAction',
                'form'=>$this->formType,
                'viewUrl'=>'adminViewUrl',
            ],
            'delete'=>[
                'class'=>'common.components.actions.LanguageDeleteAction',
                'model'=>$this->modelType,
                'viewUrl'=>'adminViewUrl',
            ],
        ]);
    }  
    
    public function actionView()
    {
        $search = current(array_keys($_GET));//take the first key as search attribute
        $model = Theme::model()->retrieve($search)->find();
        if ($model!=null){
            $this->render('view',['model'=>$model]);
       }
        else {
            throwError404(Sii::t('sii','Page not found'));
        }
    }
    /**
     * Need to custom language update as current LanguageUpdateAction have object access checks.
     * Theme administration right now does not check who is the creator
     */
    public function actionUpdate()
    {
        $form = new $this->formType($_GET['id'], 'update');
        $form->loadLocaleAttributes();
        
        if (isset($_POST[$this->formType])) {

            try {
                $form->assignLocaleAttributes($_POST[$this->formType]);

                if ($form->validateLocaleAttributes()){
                    //[2]now serialize multi-lang attribute values
                    $form->assignLocaleAttributes($_POST[$this->formType],true);

                    //[3]copy form attributes to model attributes
                    $form->modelInstance->attributes = $form->getAttributes();
                    logTrace(__METHOD__.' '.get_class($form->modelInstance), $form->modelInstance->attributes);

                    //[4] call ServiceManager to update record
                    $skipCheckAccess = false;//since this is theme admin, no creator check
                    $this->module->serviceManager->update(user()->getId(),$form->modelInstance,$skipCheckAccess);
                    user()->setFlash(get_class($form),[
                        'message'=>Sii::t('sii','Theme {name} is updated successfully',['{name}'=>$form->theme]),
                        'type'=>'success',
                        'title'=>Sii::t('sii','Theme Update'),
                    ]);
                    
                }
                else {
                    logError(__METHOD__.' form validation error', $form->getErrors(), false);
                    throw new CException(Sii::t('sii','Validation Error'));
                }

             } catch (CException $e) {
                logTrace(__METHOD__.' ===== exception ========== ',$e->getMessage());
                //serialize multi-lang attribute values before returning error
                $form->assignLocaleAttributes($_POST[$this->formType],true);                     
                user()->setFlash(get_class($form),[
                    'message'=>$e->getMessage(),
                    'type'=>'error',
                    'title'=>Sii::t('sii','Theme Error'),
                ]);
            }
        }           
       
        $this->render('update',['model'=>$form]);
    }
    /**
     * Return page menu (with auto active class)
     * @param type $model
     * @return type
     */
    public function getPageMenu($model)
    {
        $menu = [
            ['id'=>'view','title'=>Sii::t('sii','View {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','view'),  'url'=>$model->adminViewUrl,'linkOptions'=>['class'=>$this->action->id=='view'?'active':'']],
            ['id'=>'create','title'=>Sii::t('sii','Create {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','create'), 'url'=>['create']],
            ['id'=>'update','title'=>Sii::t('sii','Update {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','update'), 'url'=>['update', 'id'=>$model->id],'linkOptions'=>['class'=>$this->action->id=='update'?'active':'']],
            ['id'=>'delete','title'=>Sii::t('sii','Delete {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','delete'), 'visible'=>$model->deletable(), 
                'linkOptions'=>[
                    'submit'=>['delete','id'=>$model->id],
                    'onclick'=>'$(\'.page-loader\').show();',
                    'confirm'=>Sii::t('sii','Are you sure you want to delete this {object}?',['{object}'=>strtolower($model->displayName())]),
                ]
            ],
        ];
        if ($this->action->id=='view'){
            $menu = array_merge($menu,[
                ['id'=>'activate','title'=>Sii::t('sii','Activate {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','activate'), 'visible'=>$model->activable(), 
                    'linkOptions'=>[
                        'submit'=>url('themes/admin/activate',['Theme[id]'=>$model->id]),
                        'onclick'=>'$(\'.page-loader\').show();',
                        'confirm'=>Sii::t('sii','Are you sure you want to activate this {object}?',['{object}'=>strtolower($model->displayName())]),
                        //'class'=>'activate',
                ]],
                ['id'=>'deactivate','title'=>Sii::t('sii','Deactivate {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','deactivate'), 'visible'=>$model->deactivable(), 
                    'linkOptions'=>[
                        'submit'=>url('themes/admin/deactivate',['Theme[id]'=>$model->id]),
                        'onclick'=>'$(\'.page-loader\').show();',
                        'confirm'=>Sii::t('sii','Are you sure you want to deactivate this {object}?',['{object}'=>strtolower($model->displayName())]),
                        //'class'=>'deactivate',
                ]],
            ]);
        }
        return $menu;
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
