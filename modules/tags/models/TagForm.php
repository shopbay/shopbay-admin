<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of TagForm
 *
 * @author kwlok
 */
class TagForm extends LanguageForm 
{
    public static $displayNameLength = 100;
   /*
     * Inherited attributes
     */
    public $model = 'Tag';
    /*
     * Local attributes
     */
    public $name;
    public $display_name;
    /**
     * Behaviors for this model
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(),[
            'locale' => [
                'class'=>'common.components.behaviors.LocaleBehavior',
                'ownerParent'=>'self',
                'localeAttribute'=>null,
            ],                      
        ]);
    }         
    /**
     * @return array Definitions of form attributes that requires multi languages
     */       
    public function localeAttributes()
    {
        return [
            'display_name'=>[
                'required'=>true,
                'inputType'=>'textField',
                'inputHtmlOptions'=>['size'=>100,'maxlength'=>static::$displayNameLength],
            ],
        ];
    }    
    /**
     * Validation rules for locale attributes
     * 
     * Note: that all different locale values of one attributes are to be stored in db table column
     * Hence, model attribute (table column) wil have separate validation rules following underlying table definition
     * 
     * @return array validation rules for locale attributes.
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            ['name, display_name', 'required'],
            ['name', 'length', 'max'=>50],
            ['name', 'ruleNameWhitelist'],
            ['display_name', 'length', 'max'=>static::$displayNameLength],
        ]);
    }
    /**
     * Verify name whitelist method
     * @param type $attribute
     * @param type $params
     * @return type
     */
    public function ruleNameWhitelist($attribute,$params)
    {
        $this->modelInstance->name = $this->name;
        $this->modelInstance->validate(['name']);
        if ($this->modelInstance->hasErrors())
            $this->addErrors($this->modelInstance->getErrors());
    }      
    /**
     * Return multi-lang attributes that inherited form specifically owns
     * @return type
     */
    public function getLocaleAttributes()
    {
        $attributes = parent::getLocaleAttributes();
        unset($attributes['shop_id']);//tutorial has no this field
        return $attributes;
    }

}
