<?php
$this->widget('common.widgets.SGridView', array(
    'id'=>'subscription_grid',
    'dataProvider'=> $subscriptionDataProvider,
    'columns'=>array(
        'id',
        'subscription_no',
        array(
            'name'=>'package_id',
            'value'=>'$data->name',
        ),
        array(
            'name'=>'plan_id',
            'value'=>'$data->planName',
        ),
        'start_date',
        'end_date',
        'charged',
        'transaction_data',
        array(
            'header'=>'Permission',
            'value'=>'$data->hasRbacAssignment?\'Yes\':\'No\'',
        ),
        array(
            'name'=>'create_time',
            'value'=>'date("Y-m-d H:i:s", $data->create_time)',//cannot use LocaleBehavior as this will break NotificationManager::_parseSubject()
            'htmlOptions'=>array('style'=>'text-align:center;width:12%'),
        ),
        array(
            'name'=>'update_time',
            'value'=>'date("Y-m-d H:i:s", $data->update_time)',
            'htmlOptions'=>array('style'=>'text-align:center;width:12%'),
        ),
        array(
            'name'=>'status',
            'value'=>'Process::getHtmlDisplayText($data->status)',
            'htmlOptions'=>array('style'=>'text-align:center;width:8%'),
            'type'=>'html',
        ),
    ),
));

$this->widget('common.widgets.SGridView', array(
    'id'=>'permission_grid',
    'dataProvider'=> $permissionDataProvider,
    'columns'=>array(
        array(
            'header'=>'Permission',
            'value'=>'$data->item_name',
            'htmlOptions'=>array('style'=>'text-align:center;'),
        ),
        array(
            'name'=>'created_at',
            'value'=>'date("Y-m-d H:i:s", $data->created_at)',//cannot use LocaleBehavior as this will break NotificationManager::_parseSubject()
            'htmlOptions'=>array('style'=>'text-align:center;'),
        ),
    ),
));
