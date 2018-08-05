<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.modules.plans.models.Subscription');
/**
 * Description of FeatureController
 * @todo This controller currently has no permissions set. Only Superuser can access for now
 * 
 * @author kwlok
 */
class FeatureController extends AuthenticatedController
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
        $this->registerJui();
        $this->registerGridViewCssFile();
        $this->modelType = 'Feature';
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
     * Lists all models.
     */
    public function actionIndex($category=null)
    {
        $this->render('index',array(
            'dataProvider'=>new CActiveDataProvider('Feature')
        ));
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $form = new FeatureForm;

        if(isset($_POST['FeatureForm']))
        {
            $form->attributes=$_POST['FeatureForm'];
            if ($form->validate()){
                
                $model = new $this->modelType;
                $model->attributes = $form->attributes;
                $model = $model->saveAsRbac($form->rbacRule);
                if(!$model->hasErrors()){
                    //to clear cache as well to get update take effect 
                    Yii::app()->commonCache->delete(SCache::FEATURE_CACHE.$model->name);        
                    Yii::app()->commonCache->delete(SCache::FEATURES_CACHE);//clear all features cache also to let it reload again
                    user()->setFlash(get_class($model),array(
                        'message'=>null,
                        'type'=>'success',
                        'title'=>Sii::t('sii','Create Feature {id} successful.',['{id}'=>$model->id])));
                    $this->redirect(array('view','id'=>$model->id));
                }
                else {
                    $form->errors = $model->errors;
                }
                
            }
        }

        $this->render('create',array(
                'model'=>$form,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST['Feature']))
        {
            $model->attributes=$_POST['Feature'];
            if($model->save()){
                //to clear cache as well to get update take effect 
                Yii::app()->commonCache->delete(SCache::FEATURE_CACHE.$model->name);        
                Yii::app()->commonCache->delete(SCache::FEATURES_CACHE);//clear all features cache also to let it reload again
                user()->setFlash(get_class($model),array(
                    'message'=>Sii::t('sii','Cache PUBLISHED_PACKAGES is cleared as well'),
                    'type'=>'success',
                    'title'=>Sii::t('sii','Update Feature {id} successful.',['{id}'=>$id])));
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('update',array(
                'model'=>$model,
        ));
    }
    
    public function parseFeatureParams($model)
    {
        $params = json_decode($model->params,true);
        if (is_array($params))
            return Helper::htmlSmartKeyValues($params);
        else {
            return $model->params;
        }
        
    }
}
