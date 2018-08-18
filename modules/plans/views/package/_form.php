<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'package-form',
        'enableAjaxValidation'=>false,
)); ?>

        <?php if ($model->isNewRecord):?>
        <p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>
        <?php endif;?>

        <?php //echo $form->errorSummary($model,null,null,array('style'=>'width:57%')); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>255,'disabled'=>!$model->isNewRecord)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
        
        <div class="row" style="margin-top:10px;">
            <?php echo $form->labelEx($model,'type',array('style'=>'margin-bottom:3px;')); ?>
            <?php echo $form->dropDownList($model,'type', 
                                            Package::getTypes(), 
                                            array('prompt'=>'',
                                                  'disabled'=>!$model->isNewRecord,
                                                  'class'=>'chzn-select-type',
                                                  'data-placeholder'=>Sii::t('sii','Select Type'),
                                                  'style'=>'width:200px;'));
            ?>
            <?php echo $form->error($model,'type'); ?>
        </div>        
        
        <div class="row" style="padding-top:10px;clear:both">
            <?php echo $form->label($model,'plans',array('style'=>'margin-bottom:5px;','required'=>true)); ?>
            <?php if ($model->isNewRecord):?>
                <?php echo CHtml::activeDropDownList(
                            $model,
                            'plans',
                            $this->getApprovedPlans(),
                            array(
                                'prompt'=>'',
                                'multiple'=>true,
                                'encode'=>false,
                                'class'=>'chzn-select-plans',
                                'data-placeholder'=>Sii::t('sii','Select Plans'),
                                'style'=>'width:300px;')
                        );
                ?>
            <?php else:?>
                <?php foreach ($model->plans as $plan) {
                          echo CHtml::tag('div',array(),$this->getApprovedPlans()[$plan]);
                      }
                ?>
            <?php endif;?>
            
            <?php echo $form->error($model,'plans'); ?>
        </div>        

	<div class="row" style="clear:both;padding-top: 15px;">
            <h4>
                <?php echo Sii::t('sii','Below additional parameters are for non-internal types use:'); ?>
            </h4>
            <?php echo $form->labelEx($model,'params',array('style'=>'margin-bottom: 5px;')); ?>
            <?php foreach (Package::getParams() as $key => $value) {
                    echo CHtml::tag('span',['style'=>'width: 180px;display: inline-block;'],$value['name']);
                    echo CHtml::dropDownList('Package[params]['.$key.']',$model->getParam($key),Helper::getBooleanValues(),array('style'=>'width:80px;'));
                    echo '<br>';
                  }
            ?>
            <?php echo $form->error($model,'params'); ?>
	</div>        
        
        <div class="row" style="margin-top:20px;">
            <?php 
                $this->widget('zii.widgets.jui.CJuiButton',
                    array(
                        'name'=>'actionButton',
                        'buttonType'=>'button',
                        'caption'=> Sii::t('sii','Save'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'package-form\');}',
                        )
                );
             ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
    
<?php
$recurringType = Plan::RECURRING;
$script = <<<EOJS
$('.chzn-select-type').chosen();$('.chzn-search').hide();
$('.chzn-select-plans').chosen();$('.chzn-search').hide();
EOJS;
Helper::registerJs($script);