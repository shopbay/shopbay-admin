<div class="form">

<?php $form=$this->beginWidget('CActiveForm', [
        'id'=>'page_seo_form',
        'enableAjaxValidation'=>false,
]); ?>

    <p class="note"><?php echo Sii::t('sii','Fields with <span class="required">*</span> are required.');?></p>

    <?php //echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'name'); ?>
    <?php echo $form->hiddenField($model,'content'); ?>

    <div class="row page-label">
        <?php echo $form->labelEx($model,'seoTitle'); ?>
        <?php $this->stooltipWidget($model->getToolTip('seoTitle')); ?>
        <p>
            <?php echo $form->textField($model,'seoTitle',['size'=>95,'maxlength'=>WcmPageForm::$pageTitleLength,'placeholder'=>Sii::t('sii','Maximum {n} characters',['{n}'=>WcmPageForm::$pageTitleLength])]); ?>
            <?php echo $form->error($model,'seoTitle'); ?>
        </p>
    </div>            

    <div class="row page-label">
        <?php echo $form->labelEx($model,'seoDesc'); ?>
        <?php $this->stooltipWidget($model->getToolTip('seoDesc')); ?>
        <p>
            <?php echo $form->textArea($model,'seoDesc',['rows'=>3,'maxlength'=>WcmPageForm::$metaDescLength,'placeholder'=>Sii::t('sii','Maximum {n} characters',['{n}'=>WcmPageForm::$metaDescLength])]); ?>
            <?php echo $form->error($model,'seoDesc'); ?>
        </p>
    </div>            

    <div class="row page-label">
        <?php echo $form->labelEx($model,'seoKeywords'); ?>
        <?php $this->stooltipWidget($model->getToolTip('seoKeywords')); ?>
        <p>
            <?php echo $form->textArea($model,'seoKeywords',['rows'=>3,'maxlength'=>WcmPageForm::$metaKeywordsLength,'placeholder'=>Sii::t('sii','Maximum {n} characters',['{n}'=>WcmPageForm::$metaKeywordsLength])]); ?>
            <?php echo $form->error($model,'seoKeywords'); ?>
        </p>
    </div>          


    <div class="row" style="margin-top:20px;">
        <?php   $this->widget('zii.widgets.jui.CJuiButton',[
                    'name'=>'actionButton',
                    'buttonType'=>'button',
                    'caption'=>Sii::t('sii','Save'),
                    'value'=>'actionbtn',
                    'onclick'=>'js:function(){submitform(\'page_seo_form\');}',
                ]);
        ?>
    </div>

<?php $this->endWidget(); ?>

</div>
