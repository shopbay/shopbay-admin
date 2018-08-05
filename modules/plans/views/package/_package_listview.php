<?php
/* @var $this PackageController */
/* @var $data Package */
?>
<div class="list-box">
    <span class="status">
        <?php echo Helper::htmlColorText($data->getStatusText(),false); ?>
    </span>
    <?php 
        $this->widget('common.widgets.SDetailView', [
            'data'=>$data,
            'htmlOptions'=> ['class'=>'data'],
            'attributes'=>[
                [
                    'type'=>'raw',
                    'template'=>'<div class="heading-element">{value}</div>',
                    'value'=>CHtml::link(CHtml::encode($data->name), $data->viewUrl),
                ],
                [
                    'type'=>'raw',
                    'template'=>'<div class="element">{value}</div>',
                    'value'=>'<strong>'.Sii::t('sii','Business Ready').'<strong> '.CHtml::encode($data->businessReady),
                ],
                [
                    'type'=>'raw',
                    'template'=>'<div class="element">{value}</div>',
                    'value'=>'<strong>'.Sii::t('sii','Show Pricing').'<strong> '.CHtml::encode($data->showPricing),
                ],
                [
                    'type'=>'raw',
                    'template'=>'<div class="element">{value}</div>',
                    'value'=>'<strong>'.Sii::t('sii','Show Button').'<strong> '.CHtml::encode($data->showButton),
                ],
            ],
        ]); 
    ?> 
</div>