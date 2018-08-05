<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of SiteController
 *
 * @author kwlok
 */
class SiteController extends SSiteController 
{  
    /**
     * Specifies the local access control rules.
     * @see SSiteController::accessRules()
     * @return array access control rules
     */
    public function accessRules()
    {
        return array_merge([
            ['allow',
                'actions'=>['index'],
                'users'=>['*'],
            ],
        ],parent::accessRules());//parent access rules has to put at last
    }
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        if (user()->isGuest) {
            user()->loginRequired();
            Yii::app()->end();  
        }
        $this->redirect('welcome');
    }
    /**
     * This method is added mainly to support the "auto deployment' action that is invoked
     * by bitbucket POST hook whenever there is a git push
     * 
     * For security through obscurity we choose an action name that is difficult to guess 
     * But this requires apache (web application) user to have git access to work
     * 
     * 
     * NOTE: For development / alpha testing use only
     */
    public function action_D3_ploy()
    {
        if (param('GIT_AUTO_DEPLOY')){
            if (isset($_POST['payload'])){
                $consoleBasePath = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'console';
                $payloadfile = $consoleBasePath.'/runtime/payload.info';
                file_put_contents($payloadfile, json_encode($_POST['payload']));
                $command = 'php '.$consoleBasePath.'/console deploy --payloadFile='.$payloadfile;
                logInfo(__METHOD__.' run command: '.$command);
                $output = shell_exec($command);
                logInfo(__METHOD__.' '.$output);
            }
        }        
        else
            throwError404(Sii::t('sii','The requested page does not exist'));
    }

}
