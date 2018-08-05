<?php
/**
 * This file is part of Shopbay.org (https://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of AdminController
 *
 * @author kwlok
 */
class AdminController extends BaseUserController
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
        $this->defaultScope = 'admin';
        $this->viewName = Sii::t('sii','Admin Users');
        $this->route = 'users/admin/index';
        //-----------------//
        // SPageFilter Configuration
        $this->filterFormHomeUrl = url('users/admin');        
        $this->filterFormQuickMenu = [
            ['id'=>'create','title'=>Sii::t('sii','Create Admin User'),'subscript'=>Sii::t('sii','create'), 'url'=>url('users/admin/create')],
        ];
        //-----------------//        
    }
    /**
     * Create user.
     */
    public function actionCreate()
    {
        $form = new UserForm();
        if(isset($_POST['UserForm'])){
                
            $form->attributes = $_POST['UserForm'];

            try {

                $model = $this->module->serviceManager->create(user()->getId(),$form);
                user()->setFlash(get_class($model),[
                    'message'=>Sii::t('sii','Admin User "{name}" is created successfully.',['{name}'=>$form->name]),
                    'type'=>'success',
                    'title'=>Sii::t('sii','Admin User Creation'),
                ]);
                $this->redirect($model->viewUrl);
                Yii::app()->end();

            } catch (CException $e) {
                logError(__METHOD__.' '.$e->getTraceAsString(), [], false);
                user()->setFlash(get_class($form),[
                    'message'=>$e->getMessage(),
                    'type'=>'error',
                    'title'=>Sii::t('sii','Admin User Error'),
                ]);
            }
        }

        $this->render('create',['model'=>$form]);
    }
    /**
     * OVERRIDE METHOD
     * @see SPageIndexController
     * @return array
     */
    public function getScopeFilters()
    {
        $filters = new CMap();
        $filters->add('admin',Helper::htmlIndexFilter('Admin Users', false));
        return $filters->toArray();
    }
    /**
     * Return page menu (with auto active class)
     * @param type $model
     * @return type
     */
    public function getPageMenu($model,$taskLevel=Task::USERS_OPS,$create=true)
    {
        return parent::getPageMenu($model,$taskLevel,$create);//$create is set to true and different from parent
    }
}
