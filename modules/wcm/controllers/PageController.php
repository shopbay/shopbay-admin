<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import("wcm.models.WcmPageForm");
/**
 * Description of PageController
 *
 * @author kwlok
 */
class PageController extends WCMBaseController 
{
    use WcmContentTrait;  
    
    protected function handleUpdate() 
    {
        switch ($this->getPageSource()) {
            case 'file':
                $this->handleFileUpdate();
                break;
            default:
                $this->handleDBUpdate();
                break;
        }        
    }
    
    protected function handleFileUpdate()
    {
        if (is_array($_POST[$this->model][$this->contentAttribute])){
            $localeMessage = '[';
            foreach ($_POST[$this->model][$this->contentAttribute] as $locale => $content) {
                $localeMessage .= SLocale::getLanguages($locale).', ';
                file_put_contents($this->getDocpath($locale).'/'.$_POST[$this->model][$this->subjectAttribute].'.md',$content);
            }
            if (substr($localeMessage, -2)==', ')//remove last two unwanted chars if any
                $localeMessage = substr ($localeMessage, 0, strlen($localeMessage)-2);
            $localeMessage .= ']';
            user()->setFlash($this->id,array(
                'message'=>Sii::t('sii','"{subject}" is updated in {locale} successfully.',array(
                            '{subject}'=>$this->getContentHeading($_POST[$this->model][$this->subjectAttribute]),
                            '{locale}'=>$localeMessage,
                        )),
                'type'=>'success',
                'title'=>Sii::t('sii','Web Content Update'),
            ));
        }
    }
    
    protected function handleDBUpdate()
    {
        if (is_array($_POST[$this->model][$this->contentAttribute])){
            $localeMessage = '[';
            $pageContent = [];
            foreach ($_POST[$this->model][$this->contentAttribute] as $locale => $content) {
                $localeMessage .= SLocale::getLanguages($locale).', ';
                $pageContent[$locale] = $content;
            }
            if (substr($localeMessage, -2)==', ')//remove last two unwanted chars if any
                $localeMessage = substr ($localeMessage, 0, strlen($localeMessage)-2);
            $localeMessage .= ']';

            $model = $this->findModelBySubject($_POST[$this->model][$this->subjectAttribute]);
            if ($model===null){//insert
                $model = new WcmPage();
                $model->account_id = user()->getId();
                $model->name = $_POST[$this->model][$this->subjectAttribute];
            }

            $model->content = $pageContent;//validate each locale element first (in array form)
            if (!$model->validate())//refer to WcmPage::rulePurify
                throw new CException(Helper::implodeErrors($model->errors));//but it seems purify is not working??

            $model->account_id = user()->getId();
            $model->content = json_encode($pageContent);
            $model->save();
            WcmPage::refreshCache($_POST[$this->model][$this->subjectAttribute]);
            
            user()->setFlash($this->id,array(
                'message'=>Sii::t('sii','"{subject}" is updated in {locale} successfully.',array(
                            '{subject}'=>$this->getContentHeading($_POST[$this->model][$this->subjectAttribute]),
                            '{locale}'=>$localeMessage,
                        )),
                'type'=>'success',
                'title'=>Sii::t('sii','Web Content Update'),
            ));
        }
    }
            
    protected function getContent($subject, $locale) 
    {
        switch ($this->getPageSource()) {
            case 'file':
                return file_get_contents($this->getDocpath($locale).'/'.$subject.'.md');
            default:
                return $this->getPageContent($subject, $locale);
        }        
    }

    protected function findModelBySubject($subject)
    {
        return WcmPage::model()->findByAttributes(['name'=>$subject]);
    }
    /**
     * This action handles wcm page seo settings
     */
    public function actionSeo()
    {
        if (!isset($_GET[$this->subjectAttribute]))
            throwError404(Sii::t('sii','Content subject not found.'));
        
        $formModel = 'WcmPageForm';
        $form = new $formModel();
        $form->name = $_GET[$this->subjectAttribute];
        $form->content = $form->name.' seo';//content cannot be null; set to some dummy value
        //load form attributes for existing page if found
        $pageModel = $this->findModelBySubject($_GET[$this->subjectAttribute]);
        if ($pageModel===null){//new record
            $pageModel = new WcmPage();
            $pageModel->attributes = $form->getAttributes(['name','content']);
        }
        else {
            $form->loadSeoParamsAttributes($pageModel);
        }
        
        //Handle update if any
        if (isset($_POST[$formModel])){

            try {
                
                $form->attributes = $_POST[$formModel];
                $pageModel->params = json_encode($form->seoParams);
                $pageModel->account_id = user()->getId();
    
                if (!$pageModel->validate())
                    throw new CException(Helper::implodeErrors($model->errors));//but it seems purify is not working??

                $pageModel->save();
                WcmPage::refreshCacheSeo($form->name);

                user()->setFlash($this->id,[
                    'message'=>Sii::t('sii','"{subject}" SEO is updated successfully.',[
                        '{subject}'=>$form->displayName(),
                    ]),
                    'type'=>'success',
                    'title'=>Sii::t('sii','Web Content SEO Update'),
                ]);
                
            } catch (CException $e) {
                logError(__METHOD__,$e->getTraceAsString());
                user()->setFlash($this->id,[
                    'message'=>Sii::t('sii','Content "{subject}" update error.',['{subject}'=>$form->displayName()]).': '.$e->getMessage(),
                    'type'=>'error',
                    'title'=>Sii::t('sii','Web Content SEO Error'),
                ]);
            }
        }
        
        $this->render('seo',['model'=>$form]);
    }

}
