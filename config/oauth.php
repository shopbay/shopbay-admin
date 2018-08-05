<?php
// Customized oauth config file according to webapp context
$oauthConfig = include ROOT.'/common/config/oauth.php';
$oauthConfig['base_url'] = str_replace('{webapp_domain}', param('ADMIN_DOMAIN'), $oauthConfig['base_url']);
$oauthLog = dirname(__FILE__)."/../runtime/oauth.log";
if (!file_exists($oauthLog) && YII_DEBUG)
    file_put_contents($oauthLog, '');//create log file
$oauthConfig['debug_file'] = $oauthLog;
return $oauthConfig;