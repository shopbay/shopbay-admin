<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of ConfigsModule
 *
 * @author kwlok
 */
class ConfigsModule extends SModule
{
    /**
     * @property string the default controller.
     */
    public $entryController = 'default';
    /**
     * Behaviors for this module
     */
    public function behaviors()
    {
        return [
            'assetloader' => [
                'class'=>'common.components.behaviors.AssetLoaderBehavior',
                'name'=>'configs',
                'pathAlias'=>'configs.assets',
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
            'configs.controllers.BaseConfigController',
            'common.widgets.SButtonColumn',
        ]);
        // import module dependencies classes
        $this->setDependencies([
            'modules'=>[],
            'classes'=> [
                'listview'=>'common.widgets.SListView',
                'gridview'=>'common.widgets.SGridView',
                'imagecolumn'=>'common.widgets.EImageColumn',
            ],
        ]);

        $this->defaultController = $this->entryController;

        //load layout and common css/js files
        $this->registerScripts();
        $this->registerCssFile('application.assets.css','application.css');
    }

}