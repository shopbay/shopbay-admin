<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feature-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'group'); ?>
            <?php echo $form->dropDownList($model,'group', 
                                            Feature::siiGroup(), 
                                            array());
            ?>
            <?php echo $form->error($model,'group'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'rbacRule'); ?>
            <?php echo $form->dropDownList($model,'rbacRule', 
                                            Feature::siiRbacRules(), 
                                            array());
            ?>
            <?php echo $form->error($model,'rbacRule'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->dropDownList($model,'name', 
                                            $model->getAvailableFeatures(), 
                                            array());
            ?>            
            <?php echo $form->error($model,'name'); ?>
        </div>        
        
	<div class="row" style="clear:both;padding-top: 15px;">
		<?php echo $form->labelEx($model,'params'); ?>
		<?php echo $form->textArea($model,'params'); ?>
		<?php echo $form->error($model,'params'); ?>
	</div>

        <div class="row" style="padding-top:20px;clear:both">
            <?php 
                $this->widget('zii.widgets.jui.CJuiButton',
                    array(
                        'name'=>'actionButton',
                        'buttonType'=>'button',
                        'caption'=>Sii::t('sii','Create'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'feature-form\');}',
                        )
                );
             ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->