<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feature-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php if ($model->isNewRecord): ?>
            <div class="row">
                <?php echo $form->labelEx($model,'group'); ?>
                <?php echo $form->dropDownList($model,'group', 
                                                Feature::siiGroup(), 
                                                array());
                ?>
                <?php echo $form->error($model,'group'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'name'); ?>
            </div>        
        <?php else: ?>
        
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
                    <?php echo $form->labelEx($model,'group'); ?>
                </div>
                <div class="column">
                    <?php echo $model->group; ?>
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
                <div class="column">
                    <?php echo CHtml::label(Sii::t('sii','Rbac Rule'),'',['required'=>true]); ?>
                </div>
                <div class="column">
                    <?php echo $model->rbacRule; ?>
                </div>
            </div>        
        <?php endif; ?>
        
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
                        'caption'=>$model->isNewRecord ? Sii::t('sii','Create') : Sii::t('sii','Save'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'feature-form\');}',
                        )
                );
             ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->