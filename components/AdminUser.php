<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of AdminUser
 *
 * @author kwlok
 */
class AdminUser extends WebAdmin 
{
    /**
     * Init
     */
    public function init()
    {
        parent::init();
        $this->currentRole = Role::ADMINISTRATOR;
    }    
    
    public function afterLogin($fromCookie)
    {
        parent::afterLogin($fromCookie);
    }    
    /**
     * Construct and return profile menu according to role
     * @return array
     */
    public function getProfileMenu()
    {
        return $this->getMenuInternal('getProfileMenuItems');
    }    
    /**
     * Construct and return account menu according to role
     * @return array
     */
    public function getAccountMenu()
    {
        return $this->getMenuInternal('getAccountMenuItems');
    }       
    /**
     * Construct and return profile menu according to role
     * @return array
     */
    public function getOperationMenu()
    {
        return $this->getMenuInternal('getOperationMenu');
    }       
    
    protected function getMenuInternal($menuMethod)
    {
        $loginMenu = new AdministratorLoginMenu($this);
        return $loginMenu->{$menuMethod}();
    }
}
