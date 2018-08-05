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
                <?php echo $form->labelEx($model,'shop_id'); ?>
            </div>
            <div class="column">
                <?php echo $model->shop_id; ?>
            </div>
    	</div>

        <div class="row" style="clear:both;padding-top: 15px;">
            <div class="column">
                <?php echo $form->labelEx($model,'subscription_id'); ?>
            </div>
            <div class="column">
                <?php echo $model->subscription_id; ?>
            </div>
    	</div>
        
        <div class="row" style="clear:both;padding-top: 15px;">
            <div class="column">
                <?php echo $form->labelEx($model,'subscription_no'); ?>
            </div>
            <div class="column">
                <?php echo $model->subscription_no; ?>
            </div>
    	</div>
        
        <div class="row" style="clear:both;padding-top: 15px;">
            <div class="column">
                <?php echo $form->labelEx($model,'plan_id'); ?>
            </div>
            <div class="column">
                <?php echo $model->plan_id; ?>
            </div>
    	</div>
        
	<div class="row" style="clear:both;padding-top: 15px;">
            <div class="column">
                <?php echo $form->labelEx($model,'item_name'); ?>
            </div>
            <div class="column">
                <?php echo $model->item_name; ?>
            </div>
    	</div>
        
	<div class="row" style="clear:both;padding-top: 15px;">
		<?php echo $form->labelEx($model,'item_params'); ?>
		<?php echo $form->textArea($model,'item_params',array('rows'=>6,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'item_params'); ?>
	</div>

        <div class="row" style="padding-top:20px;clear:both">
            <?php 
                $this->widget('zii.widgets.jui.CJuiButton',
                    array(
                        'name'=>'actionButton',
                        'buttonType'=>'button',
                        'caption'=>Sii::t('sii','Save'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'config-form\');}',
                        )
                );
             ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->