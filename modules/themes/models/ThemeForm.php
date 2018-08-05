<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of ThemeForm
 *
 * @author kwlok
 */
class ThemeForm extends LanguageForm 
{
    use LanguageModelTrait;
    
    public static $nameLength = 20;
    public static $descLength = 500;
    /*
     * Inherited attributes
     */
    public $model = 'Theme';
    /*
     * Local attributes
     */
    public $name;
    public $desc;
    public $theme;
    public $theme_group;
    public $designer;
    public $price;
    public $currency;
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
            'name'=>[
                'required'=>true,
                'inputType'=>'textField',
                'inputHtmlOptions'=>['size'=>80,'maxlength'=>static::$nameLength],
            ],
            'desc'=>[
                'required'=>false,
                'purify'=>true,
                'inputType'=>'textArea',
                'inputHtmlOptions'=>['cols'=>100,'rows'=>5,'maxlength'=>static::$descLength],
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
        return [
            ['name, price, currency, designer, theme, theme_group', 'required'],
            ['name', 'length', 'max'=>static::$nameLength],
            ['desc', 'length', 'max'=>static::$descLength],
            ['designer', 'length', 'max'=>100],
            ['currency', 'length', 'max'=>3],
            ['price', 'length', 'max'=>10],
            ['price', 'type', 'type'=>'float'],
            ['theme', 'length', 'max'=>25],
            ['theme_group', 'length', 'max'=>20],
        ];
    }
    /**
     * Return multi-lang attributes that inherited form specifically owns
     * @return type
     */
    public function getLocaleAttributes()
    {
        $attributes = parent::getLocaleAttributes();
        unset($attributes['shop_id']);//theme has no this field
        return $attributes;
    }
    /**
     * Return status text
     * @param type $color
     * @return type
     */
    public function getStatusText($color=true)
    {
        return $this->modelInstance->getStatusText($color);
    }      
        
    public function getAdminViewUrl() 
    {
        return $this->modelInstance->getAdminViewUrl();
    }    
}

