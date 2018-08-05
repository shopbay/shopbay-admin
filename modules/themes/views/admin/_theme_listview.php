<?php
/* @var $this ManagementController */
/* @var $data Tag */
?>
<div class="list-box">
    <span class="status">
        <?php echo Helper::htmlColorText($data->getStatusText(),false); ?>
    </span>
    <?php $this->widget('common.widgets.SDetailView', [
            'data'=>$data,
            'htmlOptions'=>['class'=>'data'],
            'attributes'=>[
                [
                    'type'=>'raw',
                    'template'=>'<div class="heading-element">{value}</div>',
                    'value'=>CHtml::link(CHtml::encode($data->displayLanguageValue('name',user()->getLocale())), $data->adminViewUrl),
                ],
                [
                    'type'=>'raw',
                    'template'=>'<div class="element">{value}</div>',
                    'value'=>'<strong>'.CHtml::encode($data->getAttributeLabel('theme')).'</strong>'.
                             CHtml::encode($data->theme),
                ],
                [
                    'type'=>'raw',
                    'template'=>'<div class="element">{value}</div>',
                    'value'=>'<strong>'.CHtml::encode($data->getAttributeLabel('theme_group')).'</strong>'.
                             CHtml::encode($data->theme_group),
                ],
                [
                    'type'=>'raw',
                    'template'=>'<div class="element">{value}</div>',
                    'value'=>'<strong>'.CHtml::encode($data->getAttributeLabel('designer')).'</strong>'.
                             CHtml::encode($data->designer),
                ],
                [
                    'type'=>'raw',
                    'template'=>'<div class="element">{value}</div>',
                    'value'=>'<strong>'.CHtml::encode($data->getAttributeLabel('price')).'</strong>'.
                             CHtml::encode($data->currency.$data->price),
                ],
            ],
        ]); 
    ?> 
</div>