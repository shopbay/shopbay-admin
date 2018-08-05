<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of ErrorController
 *
 * @author kwlok
 */
class ErrorController extends SErrorController 
{
    /**
     * Initializes the controller.
     */
    public function init()
    {
        parent::init();
        $this->forceLogout = [403];
    }     
}
