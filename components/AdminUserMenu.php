<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import("common.widgets.susermenu.SUserMenu");
Yii::import("common.widgets.susermenu.components.*");
/**
 * Description of AdminUserMenu
 *
 * @author kwlok
 */
class AdminUserMenu extends SUserMenu
{
    /**
     * Run widget
     * @throws CException
     */
    public function run()
    {
        if (!isset($this->user))
            throw new CException(__CLASS__." User cannot be null");
        
        $this->renderMenu('AdminMenuContent', $this->offCanvas);
    }  
}

/**
 * Description of AdminMenuContent
 * 
 * @author kwlok
 */
class AdminMenuContent extends UserMenu 
{
    /**
     * Constructor
     */
    public function __construct($user,$config=[]) 
    {
        $this->user = $user;
        $this->loadConfig($config);
        
        $langMenu = new LangMenu($user);
        
        if ($user->isAuthenticated){
            if ($this->offCanvas){
                $loginMenu = new LoginMenu($user);
                $this->items = array_merge($loginMenu->items,$langMenu->items);
            }
            else {
                $welcomeMenu = new WelcomeMenu($user,['offCanvas'=>$this->offCanvas]);
                $this->items = array_merge($langMenu->items,$welcomeMenu->items);
            }
        }
        else {
            $this->items = $langMenu->items;//display language menu only
        }
        
    }  
    
    public function getMobileButton()
    {
        $button = CHtml::openTag('div',['class'=>'mobile-button mobile-admin']);
        
        if (!$this->user->isGuest)
            $button .= CHtml::link(CHtml::tag('i',['class'=>'fa avatar'],$this->user->getAvatar(Image::VERSION_XXSMALL)),'javascript:void(0);',['onclick'=>'openoffcanvasadminmenu();']);
        else
            $button .= CHtml::link('<i class="fa fa-navicon"></i>','javascript:void(0);',['onclick'=>'openoffcanvasadminmenu();']);
        
        $button .= CHtml::closeTag('div');
        return $button;        
    }

}
