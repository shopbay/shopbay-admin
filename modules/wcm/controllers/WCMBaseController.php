<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of WCMBaseController
 *
 * @author kwlok
 */
abstract class WCMBaseController extends AuthenticatedController 
{    
    protected $model = 'wcm';
    protected $subjectAttribute = 'subject';
    protected $contentAttribute = 'content';
    protected $updateRoute = 'wcm/page/update';

    abstract protected function handleUpdate();
    abstract protected function getContent($subject,$locale);
    
    public function actionIndex()
    {
        if (!isset($_GET[$this->subjectAttribute]))
            throwError404(Sii::t('sii','Content subject not found.'));
        
        $this->render('wcm.views.page.index',['subject'=>$_GET[$this->subjectAttribute]]);
    }

    public function actionUpdate()
    {
        if (isset($_POST[$this->model][$this->subjectAttribute]) && isset($_POST[$this->model][$this->contentAttribute])){
            try {
                $this->handleUpdate();
            } catch (CException $e) {
                logError(__METHOD__,$e->getTraceAsString());
                user()->setFlash($this->id,[
                    'message'=>Sii::t('sii','Content "{subject}" update error.',['{subject}'=>$this->getContentHeading($_POST[$this->model][$this->subjectAttribute])]).': '.$e->getMessage(),
                    'type'=>'error',
                    'title'=>Sii::t('sii','Web Content Error'),
                ]);
            }
            $this->render('wcm.views.page.index',['subject'=>$_POST[$this->model][$this->subjectAttribute]]);
            Yii::app()->end();
        }
        throwError403(Sii::t('sii','Unauthorized Access'));
    }
    
    protected function getLocaleContent($subject)
    {
        $content = [];
        foreach (SLocale::getLanguages() as $locale => $localeText) {
            $content[] = [
                'key'=>$subject.'-'.$locale,
                'title'=>$localeText,
                'content'=>CHtml::textArea($this->model.'['.$this->contentAttribute.']['.$locale.']',$this->getContent($subject, $locale),array('rows'=>25)),
            ];
        }     
        return $content;
    }    
    
    protected function getContentHeading($subject) 
    {
        switch ($subject) {
            case 'about':
                return Sii::t('sii','About Us');
            case 'values':
                return Sii::t('sii','Core Values');
            case 'investors':
                return Sii::t('sii','Our Investors');
            case 'careers':
                return Sii::t('sii','Careers');
            case 'terms_general':
                return Sii::t('sii','Terms of Service');
            case 'terms_merchant':
                return Sii::t('sii','Terms of Merchant Service');
            case 'privacy':
                return Sii::t('sii','Privacy Policy');
            case 'common_features':
                return Sii::t('sii','Common Features');
            case 'custom_quote':
                return Sii::t('sii','Custom Quote');
            case strpos($subject,'landing')!==false:
                $landing = explode('_', $subject);
                return Sii::t('sii','Landing').' '.ucfirst($landing[1]);
            case strpos($subject,'features')!==false:
                $feature = explode('_', $subject);
                return Sii::t('sii','Feature').' '.ucfirst($feature[1]);
            case strpos($subject,'package')!==false:
                $package = explode('_', $subject);
                return Sii::t('sii','Package').' '.Package::siiName($package[1]);
            case 'pricing':
                return Sii::t('sii','Pricing Overview');
            case 'faq':
                return Sii::t('sii','FAQ');
            default:
                return Sii::t('sii','undefined');
        }
    }
    
    protected function getBreadcrumbs($subject) 
    {
        switch ($subject) {
            case 'about':
            case 'values':
            case 'investors':
                return [
                    Sii::t('sii','Web Content'),
                    Sii::t('sii','Corporate'),
                    $this->getContentHeading($subject)
                ];
            case 'terms_general':
            case 'terms_merchant':
            case 'privacy':
                return [
                    Sii::t('sii','Web Content'),
                    Sii::t('sii','Legal'),
                    $this->getContentHeading($subject)
                ];
            default:
                return [
                    Sii::t('sii','Web Content'),
                    $this->getContentHeading($subject)
                ];
        }
    }
}
