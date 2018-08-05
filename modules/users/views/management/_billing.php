<?php
$this->widget('common.widgets.SDetailView', array(
    'data'=>$billing,
    'columns'=>array(
        array(
            array('name'=>'customer_id','value'=> $billing->customer_id),
        ),
        array(
            array('name'=>'email','value'=> $billing->email),
        ),
        array(
            array('name'=>'billed_to','value'=> $billing->billed_to),
        ),
        array(
            array('name'=>'billing_day_of_month','value'=> $billing->billing_day_of_month),
        ),
    ),
));

$this->widget('common.widgets.SGridView', array(
    'id'=>'receipt_grid',
    'dataProvider'=> $receiptDataProvider,
    'columns'=>array(
        'id',
        'receipt_no',
        array(
            'header'=>'Receipt Items',
            'value'=>'$data->items',
            'htmlOptions'=>array('style'=>'text-align:center;'),
        ),
        'amount',
        'currency',
        'reference',
        'receipt_file',
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
    ),
));