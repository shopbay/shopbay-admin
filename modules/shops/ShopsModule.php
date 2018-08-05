<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of ShopsModule
 *
 * @author kwlok
 */
class ShopsModule extends SModule 
{
    /**
     * @property string the default controller.
     */
    public $entryController = 'undefined';
    /**
     * Behaviors for this module
     */
    public function behaviors()
    {
        return [
            'assetloader' => [
                'class'=>'common.components.behaviors.AssetLoaderBehavior',
                'name'=>'shops',
                'pathAlias'=>'shops.assets',
            ],
        ];
    }

    public function init()
    {
        // import the module-level models and components
        $this->setImport([
            'common.widgets.spageindex.controllers.SPageIndexController',
            'common.widgets.spagemenu.SPageMenu',
            'common.widgets.spagetab.SPageTab',
            'common.widgets.spagelayout.SPageLayout',
            'common.widgets.sloader.SLoader',
            'common.widgets.SButtonColumn',
            'common.widgets.SStateDropdown',
        ]);
        // import module dependencies classes
        $this->setDependencies([
            'modules'=>[
                'themes'=>[
                    'common.modules.themes.models.*',
                ],          
                'tasks'=>[
                    'common.modules.tasks.models.*',
                ],          
                'payments'=>[
                    'common.modules.payments.models.PaymentMethod',
                ],     
                'taxes'=>[
                    'common.modules.taxes.models.Tax',
                ],     
            ],
            'classes'=>[
                'listview'=>'common.widgets.SListView',
                'gridview'=>'common.widgets.SGridView',
                'imagecolumn'=>'common.widgets.EImageColumn',
            ],
            'views'=>[
                'shopmap'=>'common.modules.shops.views.share._map',
            ],      
            'images'=> [
                'datepicker'=>['common.assets.images'=>'datepicker.gif'],
            ],
            'sii'=>[],
        ]);  

        $this->defaultController = $this->entryController;

    }
    /**
     * Module display name
     * @param $mode singular or plural, if the language supports, e.g. english
     * @return string the model display name
     */
    public function displayName($mode=Helper::SINGULAR)
    {
        return Sii::t('sii','Shop|Shops',[$mode]);
    }
    /**
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        // Set the required components.
        $this->setComponents([
            'servicemanager'=>[
                'class'=>'common.services.ShopManager',
                'model'=>'Shop',
                'runMode'=>$this->serviceMode,
            ],
        ]);
        return $this->getComponent('servicemanager');
    }
}