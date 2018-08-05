<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'theme_form',
        'enableAjaxValidation'=>false,
)); ?>

        <?php if ($model->isNewRecord):?>
        <p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>
        <?php endif;?>

        <?php echo $form->errorSummary($model,null,null,array('style'=>'width:57%')); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'theme'); ?>
            <?php if (!$model->isNewRecord):?>
                <div style="padding:10px 0px;">
                    <?php echo $model->theme; ?>
                </div>
                <?php echo $form->hiddenField($model,'theme'); ?>
            <?php else:?>
                <?php echo $form->textField($model,'theme',['size'=>80,'maxlength'=>50]); ?>
            <?php endif;?>
            <?php //echo $form->error($model,'theme'); ?>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'theme_group'); ?>
            <?php if (!$model->isNewRecord):?>
                <div style="padding:10px 0px;">
                    <?php echo $model->theme_group; ?>
                </div>
                <?php echo $form->hiddenField($model,'theme_group'); ?>
            <?php else:?>
                <?php echo $form->textField($model,'theme_group',['size'=>80,'maxlength'=>50]); ?>
            <?php endif;?>
            <?php //echo $form->error($model,'theme_group'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'designer'); ?>
            <?php echo $form->textField($model,'designer',['size'=>80,'maxlength'=>50]); ?>
            <?php //echo $form->error($model,'designer'); ?>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'currency'); ?>
            <?php echo $form->textField($model,'currency',['size'=>80,'maxlength'=>50]); ?>
            <?php //echo $form->error($model,'currency'); ?>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'price'); ?>
            <?php echo $form->textField($model,'price',['size'=>80,'maxlength'=>50]); ?>
            <?php //echo $form->error($model,'price'); ?>
        </div>
        
        <div class="row">
            <?php $model->renderForm($this);?>
        </div>
        
        <div class="row" style="margin-top:20px;">
            <?php  
                $this->widget('zii.widgets.jui.CJuiButton',[
                    'name'=>'actionButton',
                    'buttonType'=>'button',
                    'caption'=> Sii::t('sii','Save'),
                    'value'=>'actionbtn',
                    'onclick'=>'js:function(){submitform(\'theme_form\');}',
                ]);
             ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
