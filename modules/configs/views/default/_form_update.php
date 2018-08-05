<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
            <div class="column">
                <?php echo $form->labelEx($model,'id'); ?>
            </div>
            <div class="column">
                <?php echo $model->id; ?>
            </div>
    	</div>

	<div class="row" style="clear:both;padding-top: 15px;">
            <div class="column">
                <?php echo $form->labelEx($model,'category'); ?>
            </div>
            <div class="column">
                <?php echo $model->category; ?>
            </div>
    	</div>
        
	<div class="row" style="clear:both;padding-top: 15px;">
            <div class="column">
                <?php echo $form->labelEx($model,'name'); ?>
            </div>
            <div class="column">
                <?php echo $model->name; ?>
            </div>
    	</div>
        
	<div class="row" style="clear:both;padding-top: 15px;">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textArea($model,'value',array('rows'=>6,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

        <div class="row" style="padding-top:20px;clear:both">
            <?php 
                $this->widget('zii.widgets.jui.CJuiButton',
                    array(
                        'name'=>'actionButton',
                        'buttonType'=>'button',
                        'caption'=>$model->isNewRecord ? Sii::t('sii','Create') : Sii::t('sii','Save'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'config-form\');}',
                        )
                );
             ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->