<?php
$this->widget('common.widgets.SGridView', array(
    'id'=>'activity_grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
//        array(
//            'name'=>'obj_type',
//            'value'=>'SActiveRecord::resolveTablename($data->obj_type)',
//        ),
//        'obj_id',
        'event',
        'description',
        array(
            'name'=>'create_time',
            'value'=>'date("Y-m-d H:i:s", $data->create_time)',//cannot use LocaleBehavior as this will break NotificationManager::_parseSubject()
            'htmlOptions'=>array('style'=>'text-align:center;width:12%'),
        ),
    ),
));