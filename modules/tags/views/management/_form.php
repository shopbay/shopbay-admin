<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'tag-form',
        'enableAjaxValidation'=>false,
)); ?>

        <?php if ($model->isNewRecord):?>
        <p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>
        <?php endif;?>

        <?php echo $form->errorSummary($model,null,null,array('style'=>'width:57%')); ?>

        <?php if ($model->isNewRecord):?>
        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('size'=>80,'maxlength'=>50)); ?>
            <?php //echo $form->error($model,'name'); ?>
        </div>
        <?php endif;?>

        <div class="row">
            <?php $model->renderForm($this);?>
        </div>
        
        <div class="row" style="margin-top:20px;">
            <?php 
                $this->widget('zii.widgets.jui.CJuiButton',
                    array(
                        'name'=>'actionButton',
                        'buttonType'=>'button',
                        'caption'=> Sii::t('sii','Save'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'tag-form\');}',
                        )
                );
             ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
