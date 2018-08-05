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
                    'value'=>CHtml::link(CHtml::encode($data->name), $data->viewUrl),
                ),
            ),
        )); 
    ?> 
</div>