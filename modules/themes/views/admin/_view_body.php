<?php 
$this->widget('common.widgets.SDetailView', [
    'data'=>$model,
    'columns'=>[
        [
            ['name'=>'theme','type'=>'raw','value'=>$model->theme],
            ['name'=>'theme_group','value'=>$model->theme_group],
            ['name'=>'designer','value'=>$model->designer],
            ['name'=>'price','value'=>$model->currency.$model->price],
        ],
        [
            ['name'=>'account_id','type'=>'raw','value'=>$model->account->name],
            ['name'=>'create_time','value'=>$model->formatDatetime($model->create_time,true)],
            ['name'=>'update_time','value'=>$model->formatDatetime($model->update_time,true)],
        ],
    ],
]);


$model->languageForm->renderForm($this,Helper::READONLY);

dump(json_decode($model->params,true));
