<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.modules.plans.models.Subscription');
/**
 * Description of ManagementController
 *
 * @author kwlok
 */
class ManagementController extends BaseUserController
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
        $this->defaultScope = 'users';
        $this->viewName = Sii::t('sii','Users');
        $this->route = 'users/management/index';
        //-----------------//
        // SPageFilter Configuration
        $this->filterFormHomeUrl = url('users/management');        
        //-----------------//        
    }
    /**
     * OVERRIDE METHOD
     * @see SPageIndexController
     * @return array
     */
    public function getScopeFilters()
    {
        $filters = new CMap();
        $filters->add('users',Helper::htmlIndexFilter('Users', false));
        return $filters->toArray();
    }
    /**
     * Return section page
     * @param type $model
     * @return type
     */
    public function getSectionsData($model)
    {
        $sections = [];
        //section 1: Subscription
        $sections[] = (['id' => 'subscription', 'name' => Sii::t('sii', 'Subscription'), 'heading' => true, 'top' => true,
                        'viewFile' => '_subscriptions', 'viewData' => [
                            'subscriptionDataProvider' => $this->getUserDataProvider($model->id,'Subscription'),
                            'permissionDataProvider' => $this->getUserDataProvider($model->id,'SubscriptionAssignment','user_id','created_at'),
                        ]]);
        //section 2: Biling
        $sections[] = (['id' => 'subscription', 'name' => Sii::t('sii', 'Billing'), 'heading' => true, 
                        'viewFile' => '_billing', 'viewData' => [
                            'billing'=>$this->getBilling($model->id),
                            'receiptDataProvider' => $this->getUserDataProvider($model->id,'Receipt'),
                        ]]);
        //section 3: Shops
        $sections[] = (['id' => 'shops', 'name' => Sii::t('sii', 'Shops'), 'heading' => true,
                        'viewFile' => '_shops', 'viewData' => ['dataProvider' => $this->getUserDataProvider($model->id,'Shop')]]);
        return array_merge($sections,parent::getSectionsData($model));
    }

    protected function getUserDataProvider($account,$modelClass,$searchField='account_id',$orderField='create_time')
    {
        $criteria = new CDbCriteria();
        $criteria->condition = $searchField.'='.$account;
        $criteria->order = $orderField.' DESC';
        return new CActiveDataProvider($modelClass,array('criteria'=>$criteria));
    }    
    
    protected function getBilling($account)
    {
        $model = Billing::model()->mine($account)->find();
        return $model!=null?$model:new Billing();
    }        
    
}
