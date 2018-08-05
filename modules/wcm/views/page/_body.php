<div class="web-content">
    
    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'content-form',
                'action'=>url($this->updateRoute),
                'enableAjaxValidation'=>false,
        )); ?>

        <div class="row" style="margin-top:20px;">
            <?php echo CHtml::hiddenField($this->model.'['.$this->subjectAttribute.']',$subject);?>
            <?php $this->widget('SPageTab',array(
                    'tabs'=>$this->getLocaleContent($subject)
                )); 
            ?>
        </div>
        
        <div class="row" style="margin-top:20px;">
            <?php 
                $this->widget('zii.widgets.jui.CJuiButton',
                    array(
                        'name'=>'actionButton',
                        'buttonType'=>'button',
                        'caption'=> Sii::t('sii','Save'),
                        'value'=>'actionbtn',
                        'onclick'=>'js:function(){submitform(\'content-form\');}',
                        )
                );
             ?>
	</div>
        
        <?php $this->endWidget(); ?>

    </div><!-- form -->

</div>