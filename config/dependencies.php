<?php
//Set aliases and import module dependencies

$depends = [
    'base'=>[
    //----------------------
    // Alias mapping
    //----------------------
        'common' => 'shopbay-kernel', //actual folder name
        'admin'=>'shopbay-admin',
        'api' => 'shopbay-api',
    ],
    //---------------------------
    // Common modules / resources
    //---------------------------    
    'module'=>[
        'common' => [
            'import'=>[
                'components.*',
                'services.WorkflowManager',
                'models.*',
                'controllers.*',
                'extensions.*',
                'widgets.susermenu.SUserMenu',
                'widgets.SButtonColumn',
                'modules.activities.models.Activity',
                'modules.activities.behaviors.*',
                'modules.shops.components.*',
                'modules.shops.models.*',
                'modules.shops.behaviors.*',
                'modules.themes.models.*',
                'modules.tags.models.*',
                'modules.plans.models.*',
            ],
        ],
        'rights' => [
            'import'=>[
                'components.*',
            ],
            'config'=> [
                'superuserName'=>'SUPERUSER', // Name of the role with super user privileges. 
                'authenticatedName'=>'Activated', // Name of the authenticated user role. 
                'userClass'=>'Account', // Name of the user model class (match with database). 
                'userIdColumn'=>'id', // Name of the user id column in the database. 
                'userNameColumn'=>'name', // Name of the user name column in the database. 
                'enableBizRule'=>true, // Whether to enable authorization item business rules. 
                'enableBizRuleData'=>false, // Whether to enable data for business rules. 
                'displayDescription'=>true, // Whether to use item description instead of name. 
                //'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
                //'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.
                //'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested.
                'layout'=>'rights.views.layouts.main', // Layout to use for displaying Rights. 
                'appLayout'=>'application.views.layouts.authenticated', // Application layout. 
                'cssFile'=>null, // Style sheet file to use for Rights.
                //'install'=>false, // Whether to enable installer. 
                'debug'=>false, // Whether to enable debug mode.
            ],
        ],
        'accounts' => [
            'import'=> [
                'components.*',
                'users.Role',
                'users.Task',
                'users.WebAdmin',
            ],
            'config'=> [
                'apiLoginRoute'=>'oauth2/admin/login',
                'apiActivateRoute'=>'oauth2/admin/activate',
                'afterLoginRoute'=>'/welcome', 
                'afterLogoutRoute'=>'/', 
                'welcomeView'=>'index', 
                'welcomeControllerBehavior'=>'admin.components.behaviors.AdminWelcomeControllerBehavior',
            ],
        ],
        'images' => [
            'import'=> [
                'components.*',
                'components.Img',
            ],
            'config'=> [
                 'createOnDemand'=>true, // requires apache mod_rewrite enabled
            ],
        ],
        'tasks'=> [
            'import'=> [
                'models.*',
                'behaviors.WorkflowBehavior',
            ],
            'config'=> [
                'entryController'=>'admin',
            ],
        ],
        'help'=> [
            'config'=> [
                'entryController'=>'admin',
            ],
        ],
        'notifications'=> [
            'config'=> [
                'entryController'=>'management',
            ],            
        ],
        'payments'=> [
            'import'=>[
                'models.PaymentMethod',
            ],
        ],
        'questions'=> [
            'import'=> [
                'models.Question',
            ],
        ],
        'news'=> [
            'import'=> [
                'models.News',
            ],
        ],
        'messages'=> [
            'import'=> [
                'models.Message',
            ],
        ],
        'orders' => [
            'import'=> [
                'models.ShippingOrder',
            ],
        ],
        'likes' => [
            'import'=> [
                'models.Like',
            ],
        ],
        'tutorials' => [
            'import'=> [
                'models.Tutorial',
                'models.TutorialSeries',
            ],
        ],
        'tickets' => [
            'import'=> [
                'models.Ticket',
            ],
            'config'=>[
                'runAsAdmin'=>true,
            ],            
        ],
        'search' => [],
        'billings' => [
            'import'=>[
                'models.*',
            ],
        ],
        'media' => [
            'import'=>[
                'models.*',
            ],
        ],
        'pages' => [
            'import'=> [
                'models.Page',
            ],
        ],        
        //plain modules contains components/behaviors/models without controllers/views
        'brands' => [],
        'campaigns' => [],
        'products' => [],
        'shippings' => [],
        'taxes' => [],
        'inventories' => [
            'import'=>[
                'models.LowInventoryDataProvider',
            ],
        ],
    ],
    //----------------------
    // Local modules
    //----------------------
    'local'=>[
        'activities'=> [
            'config'=> [
                 'entryController'=>'admin',
            ],
        ],
        'users' => [],
        'configs'=> [],
        'shops' => [
            'config'=>[
                'entryController'=>'admin',
            ],            
        ],
        'themes' => [
            'config'=> [
                 'entryController'=>'admin',
            ],
        ],
        'tags' => [],
        'plans' => [
            'config'=> [
                 'entryController'=>'management',
            ],
        ],   
        'wcm' => [],
    ],
];

// The app directory path, e.g. /path/to/shopbay-app
$appPath = dirname(dirname(__FILE__));

loadDependencies(ROOT,$depends, $appPath);

return $depends;