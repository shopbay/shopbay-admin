<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.widgets.spageindex.controllers.SPageIndexController');
Yii::import('common.modules.shops.controllers.ShopManagementControllerTrait');
Yii::import('common.modules.shops.controllers.SettingsControllerTrait');
Yii::import('common.modules.shops.controllers.ShopSettingsControllerTrait');
/**
 * Description of AdminController
 *
 * @author kwlok
 */
class AdminController extends SPageIndexController
{
    use SettingsControllerTrait;
    use ShopManagementControllerTrait {
        getSectionsData as parentGetSectionsData;
    }
    /**
     * Init controller
     */
    public function init()
    {
        parent::init();
        $this->module->registerScripts();
        //-----------------
        // SPageIndex Configuration
        // @see SPageIndexController
        $this->modelType = 'Shop';
        $this->viewName = Sii::t('sii','Shops Administration');
        $this->route = 'shops/admin/index';
        $this->sortAttribute = 'update_time';
        $this->pageViewOption = SPageIndex::VIEW_GRID;
        $this->searchMap = [
            'shop' => 'name',
            'date' => 'create_time',
            'timezone' => 'timezone',
            'currency' => 'currency',
            'shipping' => 'id',//attribute "id" is used as proxy to search into shippings
            'payment_method' => 'slug',//attribute "slug" is used as proxy to search into payment methods
            'status'=>'status',
        ];
        //-----------------//  
        // SPageFilter Configuration
        // @see SPageFilterControllerTrait
        $this->filterFormModelClass = 'ShopFilterForm';
        $this->filterFormHomeUrl = url('shops/admin');        
    } 
    /**
     * View shop.
     */
    public function actionView($shop)
    {
        $model = Shop::model()->retrieve($shop)->find();
        $this->render('view',['model'=>$model]);
    } 
    /**
     * Update shop.
     */
    public function actionUpdate($shop)
    {
        $model = Shop::model()->retrieve($shop)->find();
        $this->render('update',['model'=>$model]);
    } 
    /**
     * Suspend shop.
     */
    public function actionSuspend()
    {
        if (isset($_GET['shop'])){
            try {
                $suspendedShop = $this->module->serviceManager->suspend(user()->id,$_GET['shop']);
                user()->setFlash($this->id,[
                    'message'=>Sii::t('sii','Shop {name} is suspended.',['{name}'=>$suspendedShop->displayLanguageValue('name',user()->getLocale())]),
                    'type'=>'success',
                    'title'=>null]);
                
            } catch (CException $ex) {
                user()->setFlash($this->id,[
                    'message'=>$ex->getMessage(),
                    'type'=>'error',
                    'title'=>null]);
            }
        }
        $this->redirect(url('shops'));
    }
    /**
     * Resume shop.
     */
    public function actionResume()
    {
        if (isset($_GET['shop'])){
            try {
                $resumedShop = $this->module->serviceManager->resume(user()->id,$_GET['shop']);
                user()->setFlash($this->id,array(
                    'message'=>Sii::t('sii','Shop {name} is resumed.',array('{name}'=>$resumedShop->displayLanguageValue('name',user()->getLocale()))),
                    'type'=>'success',
                    'title'=>null));
                
            } catch (CException $ex) {
                user()->setFlash($this->id,array(
                    'message'=>$ex->getMessage(),
                    'type'=>'error',
                    'title'=>null));
            }
        }
                    
        $this->redirect(url('shops'));
    }  
    /**
     * Return the data provider based on scope and searchModel
     * @see SPageIndexAction::getDataProvider()
     * @return mixed CActiveDataProvider or null
     */
    public function getDataProvider($scope,$searchModel=null)
    {
        $type = $this->modelType;
        $type::model()->resetScope();
        $finder = $type::model()->{$scope}();
        if ($searchModel!=null)
            $finder->getDbCriteria()->mergeWith($searchModel->getDbCriteria());
        logTrace(__METHOD__.' '.$type.'->'.$scope.'()',$finder->getDbCriteria());
        return new CActiveDataProvider($finder, [
                        'criteria'=>array(
                            'order'=>$this->sortAttribute.' DESC'),
                        'pagination'=>array('pageSize'=>Config::getSystemSetting('record_per_page')),
                        'sort'=>false,
                    ]);
    }    
    
    public function getSectionsData($model,$form=false) 
    {
        $sections = $this->parentGetSectionsData($model,$form);
        return array_merge($sections,$this->getSettingsSectionsData($model->settings));
    }
    /**
     * Return page menu (with auto active class)
     * @param type $model
     * @return type
     */
    public function getPageMenu($model)
    {
        return array(
            array('id'=>'view','title'=>Sii::t('sii','View {object}',array('{object}'=>$model->displayName())),'subscript'=>Sii::t('sii','view'),  'url'=>array('view', 'shop'=>$model->id),'linkOptions'=>array('class'=>$this->action->id=='view'?'active':'')),
            array('id'=>'update','title'=>Sii::t('sii','Update {object}',array('{object}'=>$model->displayName())),'subscript'=>Sii::t('sii','update'), 'url'=>array('update', 'shop'=>$model->id),'linkOptions'=>array('class'=>$this->action->id=='update'?'active':'')),
            array('id'=>'suspend','title'=>Sii::t('sii','Suspend {object}',array('{object}'=>$model->displayName())),'subscript'=>Sii::t('sii','suspend'), 'visible'=>$model->isSuspendable(),
                  'linkOptions'=>array(
                      'submit'=>array('suspend','shop'=>$model->id),
                      'onclick'=>'$(\'.page-loader\').show();',
                      'confirm'=>Sii::t('sii','Are you sure you want to suspend this {object}?',array('{object}'=>strtolower($model->displayName())))
                  )),

            array('id'=>'resume','title'=>Sii::t('sii','Resume {object}',array('{object}'=>$model->displayName())),'subscript'=>Sii::t('sii','resume'), 'visible'=>$model->isSuspended(),
                  'linkOptions'=>array(
                      'submit'=>array('resume','shop'=>$model->id),
                      'onclick'=>'$(\'.page-loader\').show();',
                      'confirm'=>Sii::t('sii','Are you sure you want to resume this {object}?',array('{object}'=>strtolower($model->displayName())))
                  )),
        );
    }    
    
}