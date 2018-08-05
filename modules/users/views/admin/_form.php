<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableAjaxValidation'=>false,
)); ?>

        <p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>

        <?php echo $form->errorSummary($model,null,null,array('style'=>'width:57%')); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>32,'placeholder'=>Sii::t('sii','Minimum is 6 characters'))); ?>
            <?php //echo $form->error($model,'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>100)); ?>
            <?php //echo $form->error($model,'display_name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <div>
                <?php echo Sii::t('sii','If you do not enter a password, one will be generated automatically.');?>
            </div>
            <?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
            <?php //echo $form->error($model,'name'); ?>
        </div>

        <div class="row" style="margin-top:20px;">
            <?php 
                $this->widget('zii.widgets.jui.CJuiButton',
                    array(
                        'name'=>'actionButton',
                        'buttonType'=>'button',
                        'caption'=> Sii::t('sii','Create Admin User'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'user-form\');}',
                        )
                );
             ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
