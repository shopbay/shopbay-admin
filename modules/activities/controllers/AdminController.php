<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of AdminController
 *
 * @author kwlok
 */
class AdminController extends SPageIndexController 
{
    public function init()
    {
        parent::init();
        //-----------------
        // SPageIndex Configuration
        // @see SPageIndexController
        $this->modelType = 'Activity';
        $this->pageControl = SPageIndex::CONTROL_ARROW;
        $this->viewName = Sii::t('sii','Activities');
        $this->enableViewOptions = false;
        $this->enableSearch = false;
        //-----------------//        
        $this->modelFilter = 'all';
        $this->defaultScope = 'admin';
        $this->route = 'activities/admin/index';
    }
    /**
     * OVERRIDE METHOD
     * @see SPageIndexController
     * @return array
     */
    public function getScopeFilters()
    {
        $filters = new CMap();
        $filters->add('admin',Helper::htmlIndexFilter(Sii::t('sii','My Activities'), false));
        if (user()->hasRoleTask(Task::USER_ACTIVITIES_VIEW))
            $filters->add('users',Helper::htmlIndexFilter(Sii::t('sii','Users Activities'), false));
        return $filters->toArray();
    }
}
