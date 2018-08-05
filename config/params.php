<?php
return [
    /**
     * configuraion for local information 
     */
    'SITE_NAME' => readConfig('app','name'),
    'SITE_LOGO' => false, //indicate if to use a brand image as site logo; if false, SITE_NAME will be used
    /**
     * configuration for domain
     */
    'HOST_DOMAIN' => readConfig('domain','host'),    
    'API_DOMAIN' => readConfig('domain','api'),  
    'SHOP_DOMAIN' => readConfig('domain','shop'),  
    /**
     * configuration for help wizard
     */
    'WIZARD_APP_ID' => 'admin',
    /**
     * configuraion for bitbucket auto deployment for testing
     * @see controllers/SiteController::action_D3_ploy()
     */
    'GIT_AUTO_DEPLOY' => false,
    /**
     * configuraion for OAUTH - hybridoauth login
     */
    //'OAUTH' => false,
];