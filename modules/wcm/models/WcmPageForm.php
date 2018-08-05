<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import("common.modules.pages.behaviors.PageBehavior");
Yii::import("common.modules.pages.models.PageSEOTrait");
/**
 * Description of WcmPageForm
 *
 * @author kwlok
 */
class WcmPageForm extends SFormModel 
{
    use PageSEOTrait;
    
    public $name;
    public $content;
    public $seoTitle;
    public $seoKeywords;
    public $seoDesc;        
    /**
     * Validation rules 
     */
    public function rules()
    {
        $rules= array_merge(parent::rules(),$this->seoRules(),[
            ['name, content', 'required'],
        ]);
        return $rules;
    } 
    /**
     * @return array customized attribute tooltips (name=>label)
     */
    public function attributeToolTips()
    {
        return array_merge(parent::attributeToolTips(),$this->seoAttributeToolTips(),[
            'name'=>Sii::t('sii','Wcm page subject'),
            'content'=>Sii::t('sii','Wcm page content'),
        ]);
    }

    public function displayName() 
    {
        return Sii::t('sii','{page} Page SEO',['{page}'=>ucfirst($this->name)]);
    }
    
    /**
     * Load params attributes from model instance 
     */
    public function loadSeoParamsAttributes($model)
    {
        foreach ($model->metaTagAttributes as $field => $value) {
            if (property_exists($this, $field))
                $this->$field = $value;
        }
    }    

}
