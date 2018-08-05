<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Yii::import('common.modules.plans.models.FeatureTrait');
Yii::import('common.modules.plans.models.FeatureRbac');
/**
 * Description of FeatureForm
 * @property integer $id
 * @property string $name
 * @property string $group
 * @property string $params
 * 
 * @author kwlok
 */
class FeatureForm extends CFormModel 
{
    public $id;
    public $name;
    public $group;
    public $params;
    public $rbacRule;
    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('name, group, rbacRule', 'required'),
            array('name, group', 'length', 'max'=>255),
            array('params', 'length', 'max'=>500),
        );
    }
    
    public function getAvailableFeatures()
    {
        $avail = Feature::siiName();
        //Remove features already setup
        foreach (Feature::model()->findAll() as $feature) {
            if (in_array($feature->name,array_keys($avail))){
                unset($avail[$feature->name]);
            }
        }
        //Change display text
        foreach ($avail as $name => $text) {
            $params = Feature::siiParams($name);
            logTrace(__METHOD__." $name params",$params);
            if (!empty($params) && isset($params['upperLimit'])){
                $this->params = json_encode($params);//used for sample data
                $avail[$name] = Sii::t('sii',$avail[$name],[$params['upperLimit']]);
            }
        }
        return $avail;
    }
}
