<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of UsersModule
 * Users management module (CRUD) for admin use. 
 * This module is different from Account modules which is like an identity management module (IDM).
 * 
 * @author kwlok
 */
class UsersModule extends SModule
{
    /**
     * @property string the default controller.
     */
    public $entryController = 'management';
    /**
     * Behaviors for this module
     */
    public function behaviors()
    {
        return [
            'assetloader' => [
                'class'=>'common.components.behaviors.AssetLoaderBehavior',
                'name'=>'users',
                'pathAlias'=>'users.assets',
            ],
        ];
    }
    /**
     * Module init
     */
    public function init()
    {
        // import the module-level models and components
        $this->setImport([
            'users.models.*',
            'users.components.*',
            'users.controllers.BaseUserController',
            'common.widgets.SButtonColumn',
            'common.widgets.spageindex.controllers.SPageIndexController',
        ]);
        // import module dependencies classes
        $this->setDependencies([
            'modules'=>[],
            'classes'=> [
                'listview'=>'common.widgets.SListView',
                'gridview'=>'common.widgets.SGridView',
                'imagecolumn'=>'common.widgets.EImageColumn',
            ],
            'images'=>[
                'datepicker'=>['common.assets.images'=>'datepicker.gif'],
            ],
        ]);

        $this->defaultController = $this->entryController;

        //load layout and common css/js files
        $this->registerScripts();
        $this->registerCssFile('application.assets.css','application.css');
        $this->registerFormCssFile();
        $this->registerGridViewCssFile();
    }
    /**
    * @return ServiceManager
    */
    public function getServiceManager()
    {
        // Set the required components.
        $this->setComponents([
            'servicemanager'=>[
                'class'=>'common.services.AccountManager',
                'model'=>['Account'],
                'htmlError'=>true,
            ],
        ]);
        return $this->getComponent('servicemanager');
    }

}