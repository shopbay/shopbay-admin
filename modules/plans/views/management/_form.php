<?php 
if (!$model->isNewRecord){
    cs()->registerScript('chosen-recurring','$(\'.chzn-select-recurring\').chosen();',CClientScript::POS_END);
}
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'plan-form',
        'enableAjaxValidation'=>false,
)); ?>

        <?php if ($model->isNewRecord):?>
            <p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>
        <?php else:?>
            <?php echo $form->hiddenField($model,'name');?>
            <?php echo $form->hiddenField($model,'type');?>
            <?php echo $form->hiddenField($model,'recurring');?>
            <?php echo $form->hiddenField($model,'price');?>
        <?php endif;?>

        <?php //echo $form->errorSummary($model,null,null,array('style'=>'width:57%')); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>255,'disabled'=>!$model->isNewRecord)); ?>
            <?php //echo $form->error($model,'name'); ?>
        </div>

        <div class="row" style="margin-top:10px;">
            <div class="column">
                <?php echo $form->labelEx($model,'type',array('style'=>'margin-bottom:3px;')); ?>
                <?php echo $form->dropDownList($model,'type', 
                                                Plan::getTypes(), 
                                                array('prompt'=>'',
                                                      'disabled'=>!$model->isNewRecord,
                                                      'class'=>'chzn-select',
                                                      'data-placeholder'=>Sii::t('sii','Select Type'),
                                                      'style'=>'width:200px;'));
                ?>
                <?php echo $form->error($model,'type'); ?>
            </div>
            <div class="column" style="<?php echo $model->isRecurringCharge?'display:block;':'display:none;';?>">
                <?php echo $form->labelEx($model,'recurring',array('style'=>'margin-bottom:5px;')); ?>
                <?php echo $form->dropDownList($model, 'recurring',
                                               Plan::getRecurrings(), 
                                               array('prompt'=>'',
                                                     'class'=>'chzn-select-recurring',
                                                     'disabled'=>!$model->isNewRecord,
                                                     'data-placeholder'=>Sii::t('sii','Select Recurring'),
                                                     'style'=>'width:250px;'));
                ?>
                <?php echo $form->error($model,'recurring'); ?>                
            </div>
            <div class="column" style="<?php echo $model->isTrial?'display:block;':'display:none;';?>">
                <?php echo $form->labelEx($model,'duration',array('style'=>'margin-bottom:5px;')); ?>
                <?php echo $form->textField($model,'duration',array('size'=>20,'maxlength'=>2)); ?>
                <?php echo $form->error($model,'duration'); ?>                
            </div>
	</div>
            
        <div class="row" style="padding-top:15px;clear:both">
            <div class="column">
                <?php if ($model->isNewRecord):?>
                    <?php echo $form->labelEx($model, 'currency',array('style'=>'margin-bottom:5px;')); ?>
                    <?php echo $form->dropDownList($model,'currency',
                                                         SLocale::getCurrencies(), 
                                                         array('prompt'=>'',
                                                              'style'=>'width:200px;',
                                                               'class'=>'chzn-select-currency',
                                                               'data-placeholder'=>Sii::t('sii','Select {field}',array('{field}'=>$model->getAttributeLabel('currency'))),
                                                            ));
                    ?>
                    <?php echo $form->error($model,'currency'); ?>
                <?php endif;?>
            </div>
            <div class="column">
                <?php echo $form->labelEx($model,'price',array('style'=>'margin-bottom:2px')); ?>
                 <?php if (!$model->isNewRecord):?>
                    <?php echo $model->currency;?>
                <?php endif;?>
                <?php echo $form->textField($model,'price',array('size'=>20,'maxlength'=>10,'disabled'=>!$model->isNewRecord)); ?>
                <?php echo $form->error($model,'price'); ?>
            </div>
        </div>
        
        <div class="row" style="padding-top:10px;clear:both">
            <?php echo $form->label($model,'items',array('style'=>'margin-bottom:5px;','required'=>true)); ?>
            <?php echo CHtml::activeDropDownList(
                            $model,
                            'items',
                            Feature::toArray(),
                            array(
                                'prompt'=>'',
                                'multiple'=>true,
                                'encode'=>false,
                                'class'=>'chzn-select-features',
                                'data-placeholder'=>Sii::t('sii','Select Features'),
                                'style'=>'width:800px;')
                        );
            ?>
            <?php echo $form->error($model,'items'); ?>
        </div>        

        <div class="row" style="margin-top:20px;">
            <?php 
                $this->widget('zii.widgets.jui.CJuiButton',
                    array(
                        'name'=>'actionButton',
                        'buttonType'=>'button',
                        'caption'=> Sii::t('sii','Save'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'plan-form\');}',
                        )
                );
             ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
    
<?php
$recurringType = Plan::RECURRING;
$trialType = Plan::TRIAL;
$script = <<<EOJS
$('.chzn-select').chosen();$('.chzn-search').hide();
$('.chzn-select-currency').chosen();$('.chzn-search').hide();
$('.chzn-select-features').chosen();$('.chzn-search').hide();
$('#Plan_type').change(function(){
    if ($(this).val()=='$recurringType'){
        $('#Plan_duration').parent().hide();
        $('#Plan_recurring').parent().show();
        $('.chzn-select-recurring').chosen().trigger('liszt:updated');$('.chzn-search').hide();
    }
    else if ($(this).val()=='$trialType'){
        $('#Plan_recurring').parent().hide();
        $('#Plan_duration').parent().show();
    }
    else {
        $('#Plan_recurring').parent().hide();
        $('#Plan_duration').parent().hide();
    }
});
EOJS;
Helper::registerJs($script);