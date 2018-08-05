<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.widgets.spagefilter.models.SPageFilterForm');
/**
 * Description of UserFilterForm
 * 
 * This form's attributes must match to the search model defined in controller
 * @see SPageIndexController::searchMap
 * @see SPageIndexAction::getSearchModel()
 * @see SPageIndexControllerTrait::assignFilterFormAttributes()
 * 
 * @author kwlok
 */
class UserFilterForm extends SPageFilterForm 
{
    /**
     * Form fields
     * The sequence of fields will decide its display order
     */
    public $user;
    public $email;
    public $date;
    /**
     * Initializes this model.
     */
    public function init()
    {
        $this->config = [
            'user'=>[
                'type'=>SPageFilterForm::TYPE_TEXTFIELD,
                'htmlOptions'=>['maxlength'=>100,'placeholder'=>Sii::t('sii','Enter any user name')],
            ],
            'email'=>[
                'type'=>SPageFilterForm::TYPE_TEXTFIELD,
                'htmlOptions'=>['maxlength'=>100,'placeholder'=>Sii::t('sii','Enter any email')],
            ],
            'date'=>[
                'type'=>SPageFilterForm::TYPE_DATE,
                'ops'=>[
                    SPageFilterForm::OP_LAST_24_HOURS,
                    SPageFilterForm::OP_LAST_7_DAYS,
                    SPageFilterForm::OP_LAST_30_DAYS,
                    SPageFilterForm::OP_LAST_90_DAYS,
                    SPageFilterForm::OP_EQUAL,
                    SPageFilterForm::OP_NOT_EQUAL,
                    SPageFilterForm::OP_GREATER_THAN,
                    SPageFilterForm::OP_GREATER_THAN_OR_EQUAL,
                    SPageFilterForm::OP_LESS_THAN,
                    SPageFilterForm::OP_LESS_THAN_OR_EQUAL,
                ],
                'htmlOptions'=>['maxlength'=>10,'class'=>'date-field','placeholder'=>Sii::t('sii','yyyy-mm-dd')],
            ],
        ];
    }    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['user, email', 'length', 'max'=>100],
        ];
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'user'=>Sii::t('sii','User Name'),
            'email'=>Sii::t('sii','Email'),
            'date'=>Sii::t('sii','Created At'),
        ];
    }    
}
