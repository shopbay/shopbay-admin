<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of BaseConfigController
 *
 * @author kwlok
 */
abstract class BaseConfigController extends AuthenticatedController
{
    /**
     * Init controller
     */
    public function init()
    {
        parent::init();
        $this->registerCommonFiles();
        $this->registerCssFile('application.assets.css','application.css');
        $this->registerFormCssFile();
        $this->registerGridViewCssFile();
        $this->registerJui();
    }    
    /**
     * Behaviors for this module
     */
    public function behaviors()
    {
        return array(
            'assetloader' => array(
                'class'=>'common.components.behaviors.AssetLoaderBehavior',
                'name'=>'application',
                'pathAlias'=>'application.assets',
            ),
        );
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }
    /**
     * Lists all models.
     */
    public function actionIndex($category)
    {
        $model = $this->prepareModel();
        if (isset($category))
            $model->category = $category;
        $this->render('index',['dataProvider'=>$model->search()]);
    }      
    /**
     * Lists all system config.
     */
    public function actionSystem()
    {
        $model = $this->prepareModel();
        $model->category = Config::SYSTEM;
        $this->render('admin',['model'=>$model]);
    }        
    /**
     * Lists all system config.
     */
    public function actionBusiness()
    {
        $model = $this->prepareModel();
        $model->category = Config::BUSINESS;
        $this->render('admin',['model'=>$model]);
    }        
    /**
     * Manages all configs.
     */
    public function actionAll()
    {
        $model = $this->prepareModel();
        $this->render('admin',['model'=>$model]);
    }    
    /**
     * Prepare model with attributes
     * @param type $category
     * @return \type
     */
    protected function prepareModel()
    {
        $type = $this->modelType;
        $model = new $type('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET[$this->modelType])){
            $model->attributes = $_GET[$this->modelType];
        }
        return $model;
    }
   
}
