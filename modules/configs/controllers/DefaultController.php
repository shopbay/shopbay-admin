<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of DefaultController
 *
 * @author kwlok
 */
class DefaultController extends BaseConfigController
{
    /**
     * Init controller
     */
    public function init()
    {
        parent::init();
        $this->modelType = 'Config';
    }     
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Config;

        if(isset($_POST['Config'])){
            $model->attributes=$_POST['Config'];
            if($model->save()){
                Config::refreshSetting($model->category, $model->name);
                $model->recordActivity([
                    'event'=>Activity::EVENT_CREATE,
                    'account'=>user()->getId(),
                    'description'=>$model->name,
                ]);
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('create',array(
                'model'=>$model,
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
        
        if(isset($_POST['Config'])){
            $auditTrail = $model->name.": $model->value (old)";
            $model->attributes=$_POST['Config'];
            $auditTrail .= ", $model->value (new)";
            if($model->save()){
                Config::refreshSetting($model->category, $model->name);
                $model->recordActivity([
                    'event'=>Activity::EVENT_UPDATE,
                    'account'=>user()->getId(),
                    'description'=>$auditTrail,
                ]);
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('update',array(
                'model'=>$model,
        ));
    }

}
