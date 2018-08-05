<?php 
$this->widget('common.widgets.SDetailView', array(
    'data'=>$model,
    'columns'=>array(
        array(
            array('name'=>'create_time','value'=>$model->formatDatetime($model->create_time,true)),
            array('name'=>'update_time','value'=>$model->formatDatetime($model->update_time,true)),
            array('name'=>'activate_time','value'=> $model->formatDatetime($model->activate_time,true)),
        ),
        array(
            array('name'=>'email','value'=> $model->email),
            array('name'=>'last_login_ip','value'=> $model->last_login_ip),
            array('name'=>'last_login_time','value'=> $model->formatDatetime($model->last_login_time,true)),
        ),
    ),
));
