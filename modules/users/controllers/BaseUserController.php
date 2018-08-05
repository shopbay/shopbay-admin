<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of BaseUserController
 *
 * @author kwlok
 */
abstract class BaseUserController extends SPageIndexController
{
    /**
     * Init controller
     */
    public function init()
    {
        parent::init();
        //-----------------
        // SPageIndex Configuration
        // @see SPageIndexController
        $this->modelType = 'Account';
        $this->defaultScope = 'all';
        $this->viewName = Sii::t('sii','Users');
        //$this->pageControl = SPageIndex::CONTROL_ARROW;//default disable it
        $this->pageViewOption = SPageIndex::VIEW_GRID;
        $this->sortAttribute = 'update_time';
        $this->searchMap = [
            'user' => 'name',
            'email' => 'email',
            'date' => 'create_time',
        ];        
        //-----------------//
        // SPageFilter Configuration
        // @see SPageFilterControllerTrait
        $this->filterFormModelClass = 'UserFilterForm';
        //-----------------//
    }
    /**
     * View user.
     */
    public function actionView($id)
    {
        $model = Account::model()->retrieve($id)->find();

        //serving pagination for Activity_page
        if (isset($_GET['ajax'])&&isset($_GET['Activity_page'])){
            header('Content-type: application/json');
            echo CJSON::encode($this->renderPartial('../base/_activities',['dataProvider'=>$model->searchActivities($model->id)],true));
            Yii::app()->end();
        }
        $this->render('view',['model'=>$model]);
    }
    /**
     * Suspend user.
     */
    public function actionSuspend()
    {
        if (isset($_GET['account'])){
            try {
                $suspendedAccount = $this->module->serviceManager->suspend(user()->id,$_GET['account']);
                user()->setFlash($this->modelType,array(
                    'message'=>Sii::t('sii','User {account} is suspended.',array('{account}'=>$suspendedAccount->email)),
                    'type'=>'success',
                    'title'=>null));

            } catch (CException $ex) {
                user()->setFlash($this->modelType,array(
                    'message'=>$ex->getMessage(),
                    'type'=>'error',
                    'title'=>null));
            }
            $this->render('view',['model'=>$suspendedAccount]);
            Yii::app()->end();
        }
        throwError403('Unauthorized Access');
    }
    /**
     * Resume user.
     */
    public function actionResume()
    {
        if (isset($_GET['account'])){
            try {
                $resumedAccount = $this->module->serviceManager->resume(user()->id,$_GET['account']);
                user()->setFlash($this->modelType,array(
                    'message'=>Sii::t('sii','User {account} is resumed.',array('{account}'=>$resumedAccount->email)),
                    'type'=>'success',
                    'title'=>null));

            } catch (CException $ex) {
                user()->setFlash($this->modelType,array(
                    'message'=>$ex->getMessage(),
                    'type'=>'error',
                    'title'=>null));
            }
            $this->render('view',['model'=>$resumedAccount]);
            Yii::app()->end();
        }
        throwError403('Unauthorized Access');
    }
    /**
     * Return the data provider based on scope and searchModel
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
            'criteria'=>[
                'order'=>$this->sortAttribute.' DESC',
            ],
            'pagination'=>['pageSize'=>Config::getSystemSetting('record_per_page')],
            'sort'=>false,
        ]);
    }
    /**
     * Return page menu (with auto active class)
     * @param type $model
     * @return type
     */
    public function getPageMenu($model,$taskLevel=Task::USERS_OPS,$create=false)
    {
        return array(
            array('id'=>'view','title'=>Sii::t('sii','View {object}',array('{object}'=>$model->displayName())),'subscript'=>Sii::t('sii','view'),  'url'=>$model->viewUrl,'linkOptions'=>array('class'=>$this->action->id=='view'?'active':'')),
            array('id'=>'create','title'=>Sii::t('sii','Create {object}',array('{object}'=>$model->displayName())),'subscript'=>Sii::t('sii','create'), 'url'=>array('create'),'visible'=>$create),
            array('id'=>'suspend','title'=>Sii::t('sii','Suspend {object}',array('{object}'=>$model->displayName())),'subscript'=>Sii::t('sii','suspend'), 'visible'=>$model->isSuspendable()&&User()->hasRoleTask($taskLevel),
                  'linkOptions'=>array(
                      'submit'=>array('suspend','account'=>$model->id),
                      'onclick'=>'$(\'.page-loader\').show();',
                      'confirm'=>Sii::t('sii','Are you sure you want to suspend this {object}?',array('{object}'=>strtolower($model->displayName())))
                  )),

            array('id'=>'resume','title'=>Sii::t('sii','Resume {object}',array('{object}'=>$model->displayName())),'subscript'=>Sii::t('sii','resume'), 'visible'=>$model->isSuspended()&&User()->hasRoleTask($taskLevel),
                  'linkOptions'=>array(
                      'submit'=>array('resume','account'=>$model->id),
                      'onclick'=>'$(\'.page-loader\').show();',
                      'confirm'=>Sii::t('sii','Are you sure you want to resume this {object}?',array('{object}'=>strtolower($model->displayName())))
                  )),
        );
    }
    /**
     * Return section page
     * @param type $model
     * @return type
     */
    public function getSectionsData($model)
    {
        $sections = new CList();
        $sections->add(array('id'=>'activitiy','name'=>Sii::t('sii','Activities'),'heading'=>true,
            'viewFile'=>'../base/_activities','viewData'=>array('dataProvider'=>$model->searchActivities($model->id))));
        return $sections->toArray();
    }
    /**
     * OVERRIDE METHOD
     * @see SPageIndexController
     * @return CDbCriteria
     */
    public function getSearchCriteria($model)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('name',$model->name,true);
        $criteria->compare('email',$model->email,true);
        $criteria = QueryHelper::prepareDatetimeCriteria($criteria, 'create_time', $model->create_time);

        return $criteria;
    }        
}
