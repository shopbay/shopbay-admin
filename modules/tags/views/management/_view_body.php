<?php 
$this->widget('common.widgets.SDetailView', array(
    'data'=>$model,
    'columns'=>array(
        array(
            array('name'=>'display_name','value'=> $model->tagName(user()->getLocale())),
        ),
        array(
            array('name'=>'account_id','type'=>'raw','value'=>$model->account->getAvatar(Image::VERSION_XXSMALL).' '.$model->account->name,'visible'=>user()->hasRole(Role::ADMINISTRATOR)),
            array('name'=>'create_time','value'=>$model->formatDatetime($model->create_time,true)),
            array('name'=>'update_time','value'=>$model->formatDatetime($model->update_time,true)),
        ),
    ),
));
