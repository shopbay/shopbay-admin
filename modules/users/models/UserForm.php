<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.components.validators.PasswordValidator');
/**
 * UserForm
 *
 * @author kwlok
 */
class UserForm extends SFormModel
{
    public $name;
    public $password;
    public $email;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // name, email, password are required
            array('email, name', 'required'),
            array('name', 'length', 'max'=>32),
            array('password', 'length', 'max'=>64),
            array('password', 'PasswordValidator', 'strength'=>PasswordValidator::WEAK, 'allowNull'=>true),
            array('name', 'length', 'min'=>6),

            array('email', 'email'),
            array('email', 'length', 'max'=>100),
            array('email, name', 'unique','className'=>'Account'),
        );
    }
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'name' => Sii::t('sii','Username'),
            'password' => Sii::t('sii','Password'),
            'email' => Sii::t('sii','Email Address'),
        );
    }

    public function displayName()
    {
        return Sii::t('sii','User');
    }
}
