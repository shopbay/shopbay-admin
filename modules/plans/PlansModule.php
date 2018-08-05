<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of PlansModule
 *
 * @author kwlok
 */
class PlansModule extends SModule 
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
                'name'=>'plans',
                'pathAlias'=>'plans.assets',
            ],
        ];
    }

    public function init()
    {
        // import the module-level models and components
        $this->setImport([
            'plans.models.*',
            'common.widgets.SButtonColumn',
            'common.widgets.spageindex.controllers.SPageIndexController',
        ]);

        // import module dependencies classes
        $this->setDependencies([
            'classes'=>[
                'listview'=>'common.widgets.SListView',
                'gridview'=>'common.widgets.SGridView',
            ],
            'views'=>[
                'planitemview'=>'application.modules.plans.views.management._planitem_gridview',
                'planworkflowview'=>'application.modules.plans.views.package._plan_gridview_workflow',
                'plangridview'=>'application.modules.plans.views.package._plan_gridview',
                //tasks views
                'history'=>'tasks.processhistory',
                //account views
                'profilesidebar'=>'accounts.profilesidebar',
            ],
            'sii'=>[
                //must follow this format [app-alias.module-name]
            ],
        ]);  

        $this->defaultController = $this->entryController;

        //load layout and common css/js files
        $this->registerScripts();
        $this->registerCommonFiles();
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
                'class'=>'common.services.PlanManager',
                'model'=>[
                    'Plan',
                    'Package',
                    'Subscription',
                ],
                'runMode'=>$this->serviceMode,
            ],
        ]);
        return $this->getComponent('servicemanager');
    }

}
