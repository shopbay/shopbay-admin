<?php $form=$this->beginWidget('CActiveForm', [
        'id'=>'subscribe-plan-form',
        'enableAjaxValidation'=>false,
]); ?>

        <div class="row" style="padding-top:10px;clear:both">
            <div class="column">
                <?php echo CHtml::dropDownList('subscriber',0,$this->getAdminUsersArray($model), [/*htmlOptions*/]);?>
            </div>
            <div class="column">
                <?php 
                    $this->widget('zii.widgets.jui.CJuiButton',[
                            'name'=>'actionButton',
                            'buttonType'=>'button',
                            'caption'=> Sii::t('sii','Subscribe'),
                            'value'=>'actionbtn',
                            'onclick'=>'js:function(){submitform(\'subscribe-plan-form\');}',
                        ]);
                 ?>
            </div>
        </div>        

<?php $this->endWidget(); ?>
<br>
<br>
<br>
<br>
<?php $this->renderPartial('_view_body',['model'=>$model]); ?>

