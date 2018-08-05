<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of AdminWelcomeControllerBehavior
 *
 * @author kwlok
 */
class AdminWelcomeControllerBehavior extends WelcomeControllerBehavior
{
    /**
     * @see WelcomeControllerBehavior::initBehavior()
     */
    public function initBehavior() 
    {
        Yii::app()->filter->addRule('accessControl');//add accessControl rules also
        if (!user()->isGuest)
            $this->getOwner()->rightsFilterActionsExclude = ['passwordReset'];
        //-----------------
        // SPageIndex Configuration - cont'd
        // @see SPageIndexController
        $this->getOwner()->defaultScope = 'tasks';//to display recent tasks at welcome page
    }
    /**
     * @see WelcomeControllerBehavior::loadScopeFilters()
     * @return array
     */
    public function loadScopeFilters()
    {
        $filters = new CMap();
        $filters->add('tasks',Helper::htmlIndexFilter(Sii::t('sii','Tasks'), false));
        return $filters->toArray();
    }    
    /**
     * @see WelcomeControllerBehavior::loadWidgetView()
     * @return array
     */
    public function loadWidgetView($view,$scope,$searchModel=null)
    {
        switch ($scope) {
            case 'tasks':
                $this->getOwner()->tasksView = 'tasklist';
                $this->getOwner()->modelFilter = null;
                return $this->getOwner()->renderPartial('_tasks',['role'=>Role::ADMINISTRATOR],true);
            default:
                throwError404(Sii::t('sii','The requested page does not exist'));
        }
    }     
}
