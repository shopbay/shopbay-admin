<?php
logHttpHeader();
$basepath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
$appName = basename(dirname(dirname(__FILE__)));// The app directory name, e.g. shopbay-app
$webapp = new SWebApp($appName,$basepath);
$webapp->import([
    'application.models.*',
    'application.components.*',
    'application.extensions.*',          
    'common.widgets.spageindex.controllers.SPageIndexController',
]);
$webapp->setCommonComponent('ctrlManager',['class'=> 'AdminControllerManager']);
$webapp->addComponents([
    'themeManager'=>[
        'basePath'=>$basepath.'/modules/themes/resources/site'  
    ],
    'user'=> [
        'class'=>'AdminUser',
        // enable cookie-based authentication
        'allowAutoLogin'=>true,
        'loginUrl'=>['login'],
    ],
    'urlManager'=> [
        'class'=>'AdminUrlManager',
        'hostDomain'=>$webapp->params['HOST_DOMAIN'],
        'shopDomain'=>$webapp->params['SHOP_DOMAIN'],
        //'cdnDomain'=>'',//if not set, follow admin domain
        'forceSecure'=>false,
        'urlFormat'=>'path',
        'showScriptName'=>false,
        'rules'=> [
            'login'=>'accounts/authenticate/login',
            'signin'=>'accounts/authenticate/login',
            'welcome'=>'accounts/welcome',
            'message/view/*'=>'messages/management/view',
            'tutorial/view/*'=>'tutorials/management/view',
            'tasks/tutorialseries/<action:\w+>'=>'tasks/tutorialSeries/<action>',//case sensitive
            'ticket/view/*'=>'tickets/management/view',
            'plan/view/*'=>'plans/management/view',
            'package/view/*'=>'plans/package/view',
            'media/assets/preview/*'=>'media/preview',
            'media/assets/*'=>'media/management/assets',
            'media/view/*'=>'media/management/view',
            'media/download/*'=>'media/management/download',
            //'<controller:\w+>/<id:\d+>'=>'<controller>/view',
            //'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
            //'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        ],
    ],
    'request' => [
        'class' => 'common.components.SHttpRequest',
        'enableCsrfValidation' => true,
        'enableCookieValidation'=>true,
        'csrfTokenName'=>$webapp->params['CSRF_TOKEN_NAME'],
    ],
    'filter'=> [
        'class'=>'SFilter',
        'rules'=>['flash','welcome'],
    ],
]);
return $webapp->toArray();