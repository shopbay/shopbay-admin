<?php
/* @var $this ManagementController */
/* @var $data Tag */
?>
<div class="list-box">
    <?php $this->widget('common.widgets.SDetailView', array(
            'data'=>$data,
            'htmlOptions'=>array('class'=>'data'),
            'attributes'=>array(
                array(
                    'type'=>'raw',
                    'template'=>'<div class="heading-element">{value}</div>',
                    'value'=>CHtml::link(CHtml::encode($data->tagName(user()->getLocale())), $data->viewUrl),
                ),
                array(
                    'type'=>'raw',
                    'template'=>'<div class="element">{value}</div>',
                    'value'=>'<strong>'.CHtml::encode($data->getAttributeLabel('name')).'</strong>'.
                            CHtml::encode($data->tagName(user()->getLocale())),
                ),
            ),
        )); 
    ?> 
</div>