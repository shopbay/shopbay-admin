<?php 
$this->widget('common.widgets.SDetailView', [
    'data'=>$model,
    'columns'=>[
        [
            ['name'=>'name','value'=> $model->name],
            ['name'=>'type','value'=> $model->typeDesc],
            ['name'=>'recurring','value'=> $model->recurringDesc,'visible'=>$model->isRecurringCharge],
            ['name'=>'duration','value'=> Sii::t('sii','{duration} days',array('{duration}'=>$model->duration)),'visible'=>$model->isTrial],
            ['name'=>'price','value'=> $model->formatCurrency($model->price,$model->currency)],
        ],
        [
            ['name'=>'account_id','type'=>'raw','value'=>$model->account->getAvatar(Image::VERSION_XXSMALL).' '.$model->account->name,'visible'=>user()->hasRole(Role::ADMINISTRATOR)],
            ['name'=>'create_time','value'=>$model->formatDatetime($model->create_time,true)],
            ['name'=>'update_time','value'=>$model->formatDatetime($model->update_time,true)],
        ],
    ],
]);