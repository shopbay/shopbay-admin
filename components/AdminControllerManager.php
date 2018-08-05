<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of AdminControllerManager
 * Manage controller stuff, like layouts, views
 * 
 * @author kwlok
 */
class AdminControllerManager extends SControllerManager
{
    /**
     * Init
     */
    public function init()
    {
        parent::init();
        //keep same layout before and after login
        $this->authenticatedLayout = $this->layout;
        $this->authenticatedHeaderView = $this->headerView;
        $this->authenticatedFooterView = $this->footerView;
    }
}
