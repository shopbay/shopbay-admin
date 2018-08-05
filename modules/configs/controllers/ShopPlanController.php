<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of ShopPlanController
 *
 * @author kwlok
 */
class ShopPlanController extends BaseConfigController
{
    /**
     * Init controller
     */
    public function init()
    {
        parent::init();
        $this->modelType = 'SubscriptionPlan';
    }   
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = $this->prepareModel();
        $this->render('index',['model'=>$model]);
    }     
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST[$this->modelType])){
            //todo Support audit trails like what is implemented in configs/account configs
            $model->attributes=$_POST[$this->modelType];
            if($model->save()){
                user()->setFlash(get_class($model),[
                    'message'=>Sii::t('sii','Shop plan is updated successfully'),
                    'type'=>'success',
                    'title'=>Sii::t('sii','Update Shop Plan {id}.',['{id}'=>$id]),
                ]);
            }
        }

        $this->render('update',[
            'model'=>$model,
        ]);
    }
}
