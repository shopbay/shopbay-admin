<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import("common.widgets.susermenu.components.UserLoginMenu");
/**
 * Description of AdministratorLoginMenu
 * Class name has to follow naming convention [Role]LoginMenu as per LoginMenu requirement
 *
 * @author kwlok
 */
class AdministratorLoginMenu extends UserLoginMenu 
{
    /**
     * Menu constructor
     * @param type $user
     * @param array $config
     */
    public function __construct($user,$config=[]) 
    {
        parent::__construct($user, $config);
        $this->user = $user;
        $this->items[static::$profile] = $this->getProfileMenu();
        $this->items[static::$account] = $this->getAccountMenu();
        $this->items[static::$logout] = $this->getLogoutMenu();
    }
    
    public function getAccountMenuItems() 
    {
        return [
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('accounts/management/password')?'active':''], Sii::t('sii','Change Password')), 'url'=>url('account/management/password'),'active'=>$this->isMenuActive('accounts/management/password')],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('accounts/management/email')?'active':''], Sii::t('sii','Change Email')),'url'=>url('account/management/email'),'active'=>$this->isMenuActive('account/management/email')],
        ];
    }

    public function getProfileMenuItems() 
    {
        return [
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('accounts/profile/index')?'active':''], Sii::t('sii','Profile')),'url'=>url('account/profile'),'active'=>$this->isMenuActive('accounts/profile/index')],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('plans/management/index')?'active':''], Sii::t('sii','Plans')),'url'=>url('plans'),'active'=>$this->isMenuActive('plans/management/index'),'visible'=>$this->user->hasRoleTask(Task::PLANS)],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('plans/package/index')?'active':''], Sii::t('sii','Packages')),'url'=>url('plans/package'),'active'=>$this->isMenuActive('plans/package/index'),'visible'=>$this->user->hasRoleTask(Task::PACKAGES)],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('tutorials/management/index')?'active':''], Sii::t('sii','Tutorials')),'url'=>url('tutorials'),'active'=>$this->isMenuActive('tutorials/management/index'),'visible'=>$this->user->hasRoleTask(Task::TUTORIALS)&&!$this->user->isSuperuser],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('tutorials/series/index')?'active':''], Sii::t('sii','Tutorial Series')),'url'=>url('tutorials/series'),'active'=>$this->isMenuActive('tutorials/series/index'),'visible'=>$this->user->hasRoleTask(Task::TUTORIAL_SERIES)&&!$this->user->isSuperuser],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('themes/admin/index')?'active':''], Sii::t('sii','Themes')),'url'=>url('themes'),'active'=>$this->isMenuActive('themes/admin/index'),'visible'=>$this->user->hasRole(Role::THEMES_ADMIN)&&!$this->user->isSuperuser],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('tags/management/index')?'active':''], Sii::t('sii','Tags')),'url'=>url('tags'),'active'=>$this->isMenuActive('tags/management/index'),'visible'=>$this->user->hasRole(Role::TAGS_MANAGER)&&!$this->user->isSuperuser],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('tickets/management/index')?'active':''], Sii::t('sii','Tickets')),'url'=>url('tickets'),'active'=>$this->isMenuActive('tickets/management/index'),'visible'=>$this->user->hasRole(Role::TICKETS_MANAGER)&&!$this->user->isSuperuser],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('media/management/index')?'active':''], Sii::t('sii','Media')),'url'=>url('media'),'active'=>$this->isMenuActive('media/management/index'),'visible'=>$this->user->hasRoleTask(Task::MEDIA)&&!$this->user->isSuperuser],
            ['label'=>CHtml::tag('div', ['class'=>$this->isMenuActive('activities/admin/index')?'active':''], Sii::t('sii','Activities')),'url'=>url('activities'),'active'=>$this->isMenuActive('activities/admin/index')],
        ];     
    }
    /**
     * Construct and return operation menu
     * @return array
     */
    public function getOperationMenu()
    {
        $commonmenu = [
            ['label'=>Sii::t('sii','My Account'), 'items'=>[
                ['label'=>Sii::t('sii','View Profile'), 'url'=>Yii::app()->createUrl('accounts/profile')],
                ['label'=>Sii::t('sii','Manage Account'), 'url'=>Yii::app()->createUrl('account')],
                ['label'=>Sii::t('sii','My Stuff'),'items'=>[
                        ['label'=>Sii::t('sii','Plans'), 'url'=>Yii::app()->createUrl('plans'),'visible'=>$this->user->hasRoleTask(Task::PLANS)],
                        ['label'=>Sii::t('sii','Packages'), 'url'=>Yii::app()->createUrl('plans/package'),'visible'=>$this->user->hasRoleTask(Task::PACKAGES)],
                        ['label'=>Sii::t('sii','Tutorials'), 'url'=>Yii::app()->createUrl('tutorials'),'visible'=>$this->user->hasRoleTask(Task::TUTORIALS)&&!$this->user->isSuperuser],
                        ['label'=>Sii::t('sii','Tutorial Series'), 'url'=>Yii::app()->createUrl('tutorials/series'),'visible'=>$this->user->hasRoleTask(Task::TUTORIAL_SERIES)&&!$this->user->isSuperuser],
                        ['label'=>Sii::t('sii','Media'), 'url'=>Yii::app()->createUrl('media'),'visible'=>$this->user->hasRoleTask(Task::MEDIA)&&!$this->user->isSuperuser],
                        ['label'=>Sii::t('sii','Activities'), 'url'=>Yii::app()->createUrl('activities')],
                    ],
                ],
              ],
            ],
            ['label'=>Sii::t('sii','Help'),'url'=>Yii::app()->createUrl('help/admin')],
        ];
        if ($this->user->isSuperuser)
            $menu  = array_merge($this->getSuperuserMenu(),$commonmenu);
        else {
            $cnt = $this->user->getUnreadMessageCount();
            $newmsg = $cnt>0 ?'<span class="counter" style="display:inline">'.$cnt.'</span>':'';   
            $adminmenu = [
                ['label'=>Sii::t('sii','Inbox').$newmsg,'url'=>Yii::app()->createUrl('messages')],
                ['label'=>Sii::t('sii','My Tasks'),'url'=>Yii::app()->createUrl('tasks')],
                ['label'=>Sii::t('sii','Operations'),'items'=>[
                        ['label'=>Sii::t('sii','Users'), 'url'=>Yii::app()->createUrl('users'),'visible'=>$this->user->hasRoleTask(Task::USERS)],
                        ['label'=>Sii::t('sii','Shops'), 'url'=>Yii::app()->createUrl('shops/admin'),'visible'=>$this->user->hasRoleTask(Task::SHOPS_ADMINISTRATION)],
                        ['label'=>Sii::t('sii','Tags'), 'url'=>Yii::app()->createUrl('tags'),'visible'=>$this->user->hasRole(Role::TAGS_MANAGER)],
                        ['label'=>Sii::t('sii','Themes'), 'url'=>Yii::app()->createUrl('themes'),'visible'=>$this->user->hasRole(Role::THEMES_ADMIN)],
                        ['label'=>Sii::t('sii','Tickets'), 'url'=>Yii::app()->createUrl('tickets'),'visible'=>$this->user->hasRole(Role::TICKETS_MANAGER)],
                        ['label'=>Sii::t('sii','Notification Templates'), 'url'=>Yii::app()->createUrl('notifications'),'visible'=>$this->user->hasRole(Role::NOTIFICATION_TEMPLATES_MANAGER)],
                        ['label'=>Sii::t('sii','System Emails'), 'url'=>Yii::app()->createUrl('notifications/emailTrail'),'visible'=>$this->user->hasRoleTask(Task::SYSTEM_EMAILS)],
                        ['label'=>Sii::t('sii','General Configs'),'visible'=>$this->user->hasRoleTask(Task::CONFIGS_DEFAULT),
                            'items'=>[
                                ['label'=>Sii::t('sii','System'),'url'=>Yii::app()->createUrl('configs/default/system')],
                                ['label'=>Sii::t('sii','Business'),'url'=>Yii::app()->createUrl('configs/default/business')],
                            ],
                        ],
                        ['label'=>Sii::t('sii','Account Configs'),'visible'=>$this->user->hasRoleTask(Task::CONFIGS_ACCOUNT),
                            'items'=>[
                                ['label'=>Sii::t('sii','System'),'url'=>Yii::app()->createUrl('configs/account/system')],
                                ['label'=>Sii::t('sii','Business'),'url'=>Yii::app()->createUrl('configs/account/business')],
                            ],
                        ],
                        ['label'=>Sii::t('sii','Shop Plans Configs'), 'url'=>Yii::app()->createUrl('configs/shopplan'),'visible'=>$this->user->hasRole(Role::SHOP_PLANS_MANAGER)],
                        //['label'=>Sii::t('sii','Orders'), 'url'=>Yii::app()->createUrl('orders')),
                        //['label'=>Sii::t('sii','Carts'), 'url'=>Yii::app()->createUrl('cart')),
                    ],
                ],
                ['label'=>Sii::t('sii','Web Content'),'items'=>$this->getWebContentMenu(),'visible'=>$this->user->hasRole(Role::WCM_MANAGER)],
            ];
            $menu  = array_merge($adminmenu,$commonmenu);
        }
        return isset($menu)?$menu:[];
    }     
    /**
     * Construct and return web content menu
     * @return array
     */
    public function getWebContentMenu()
    {
        return [
            ['label'=>Sii::t('sii','Landing Page'),
                'items'=>[
                    ['label'=>Sii::t('sii','Overview'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'landing_overview'])],
                    ['label'=>Sii::t('sii','Highlight 1'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'landing_highlight1'])],
                    ['label'=>Sii::t('sii','Highlight 2'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'landing_highlight2'])],
                    ['label'=>Sii::t('sii','Highlight 3'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'landing_highlight3'])],
                    ['label'=>Sii::t('sii','Highlight 4'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'landing_highlight4'])],
                    ['label'=>Sii::t('sii','Highlight 5'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'landing_highlight5'])],
                    ['label'=>Sii::t('sii','SEO'), 'url'=>Yii::app()->createUrl('wcm/page/seo',['subject'=>'landing'])],
                ],
            ],
            ['label'=>Sii::t('sii','Features'),
                'items'=>[
                    ['label'=>Sii::t('sii','Overview'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_overview'])],
                    ['label'=>Sii::t('sii','Highlights'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_highlights'])],
                    ['label'=>Sii::t('sii','Website Builder'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_website'])],
                    ['label'=>Sii::t('sii','Chatbots'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_chatbots'])],
                    ['label'=>Sii::t('sii','Theme Store'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_themes'])],
                    ['label'=>Sii::t('sii','Products and Inventory'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_products'])],
                    ['label'=>Sii::t('sii','Shopping Cart'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_cart'])],
                    ['label'=>Sii::t('sii','Payment Gateway'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_payments'])],
                    ['label'=>Sii::t('sii','Orders Management'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_orders'])],
                    ['label'=>Sii::t('sii','Shops Management'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_shops'])],
                    ['label'=>Sii::t('sii','Sales Channels'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_sales'])],
                    ['label'=>Sii::t('sii','Marketing Tools'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_marketing'])],
                    ['label'=>Sii::t('sii','Customer Relationship Management'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_crm'])],
                    ['label'=>Sii::t('sii','Dashboard and Analytics'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_analytics'])],
                    ['label'=>Sii::t('sii','Hosting and Security'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_hosting'])],
                    ['label'=>Sii::t('sii','Help Center'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'features_help'])],
                    ['label'=>Sii::t('sii','SEO'), 'url'=>Yii::app()->createUrl('wcm/page/seo',['subject'=>'features'])],
                ],
            ],
            ['label'=>Sii::t('sii','Pricing'), 'items'=>[
                    ['label'=>Sii::t('sii','Overview'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'pricing'])],
                    ['label'=>Sii::t('sii','Packages'), 'items'=>[
                        ['label'=>Package::siiName(Package::FREE), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'package_'.Package::FREE])],
                        ['label'=>Package::siiName(Package::LITE), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'package_'.Package::LITE])],
                        ['label'=>Package::siiName(Package::STANDARD), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'package_'.Package::STANDARD])],
                        ['label'=>Package::siiName(Package::PLUS), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'package_'.Package::PLUS])],
                        ['label'=>Package::siiName(Package::ENTERPRISE), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'package_'.Package::ENTERPRISE])],
                        ['label'=>Package::siiName(Package::CUSTOM), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'package_'.Package::CUSTOM])],
                    ],
                    ],
                    ['label'=>Sii::t('sii','Common Features'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'common_features'])],
                    ['label'=>Sii::t('sii','FAQ'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'faq'])],
                    ['label'=>Sii::t('sii','Custom Quote'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'custom_quote'])],
                    ['label'=>Sii::t('sii','SEO'), 'url'=>Yii::app()->createUrl('wcm/page/seo',['subject'=>'pricing'])],
                ],
            ],
            ['label'=>Sii::t('sii','Community'),
                'items'=>[
                    ['label'=>Sii::t('sii','Portal SEO'), 'url'=>Yii::app()->createUrl('wcm/page/seo',['subject'=>'community_portal'])],
                    ['label'=>Sii::t('sii','Tutorials SEO'), 'url'=>Yii::app()->createUrl('wcm/page/seo',['subject'=>'community_tutorials'])],
                    ['label'=>Sii::t('sii','Tutorial Series SEO'), 'url'=>Yii::app()->createUrl('wcm/page/seo',['subject'=>'community_series'])],
                    ['label'=>Sii::t('sii','Questions SEO'), 'url'=>Yii::app()->createUrl('wcm/page/seo',['subject'=>'community_questions'])],
                    ['label'=>Sii::t('sii','Topics SEO'), 'url'=>Yii::app()->createUrl('wcm/page/seo',['subject'=>'community_topics'])],
                ],
            ],
            ['label'=>Sii::t('sii','Corporate'),
                'items'=>[
                    ['label'=>Sii::t('sii','About Us'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'about'])],
                    ['label'=>Sii::t('sii','Core Values'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'values'])],
                    ['label'=>Sii::t('sii','Our Investors'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'investors'])],
                    ['label'=>Sii::t('sii','Careers'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'careers'])],
                ],
            ],
            ['label'=>Sii::t('sii','Legal'),
                'items'=>[
                    ['label'=>Sii::t('sii','Terms of General Service'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'terms_general'])],
                    ['label'=>Sii::t('sii','Terms of Merchant Service'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'terms_merchant'])],
                    ['label'=>Sii::t('sii','Privacy Policy'), 'url'=>Yii::app()->createUrl('wcm/page/index',['subject'=>'privacy'])],
                ],
            ],
            ['label'=>Sii::t('sii','Contact us'), 'url'=>Yii::app()->createUrl('content/contact')],
            ['label'=>Sii::t('sii','Press'), 'url'=>Yii::app()->createUrl('content/press')],
            ['label'=>Sii::t('sii','Help'),
                'items'=>[
                    ['label'=>Sii::t('sii','Shopping Guide'),'url'=>Yii::app()->createUrl('help/shopping')],
                    ['label'=>Sii::t('sii','Shipping Guide'),'url'=>Yii::app()->createUrl('help/shipping')],
                    ['label'=>Sii::t('sii','Payment'),'url'=>Yii::app()->createUrl('help/payment')],
                    ['label'=>Sii::t('sii','Refund'),'url'=>Yii::app()->createUrl('help/refund')],
                ],
            ],
        ];
    }
    /**
     * Construct and return superuser menu
     * @return array
     */
    protected function getSuperuserMenu()
    {
        return [
            ['label'=>CHtml::tag('div',['class'=>'alert'],Sii::t('sii','<strong>ALERT: </strong>YOU HAVE LOGIN AS SUPERUSER'))],
            ['label'=>Sii::t('sii','IT Operations'), 'items'=>[
                    ['label'=>Sii::t('sii','Admin Users'), 'url'=>Yii::app()->createUrl('users/admin')],
                    ['label'=>Sii::t('sii','Rights'), 'url'=>Yii::app()->createUrl('rights')],
                    ['label'=>Sii::t('sii','Features'), 'url'=>Yii::app()->createUrl('plans/feature')],
                ],
            ],
        ];
    }

}