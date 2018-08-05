<?php
$this->breadcrumbs=array(
	Sii::t('sii','Configs')=>url('configs'),
	Sii::t('sii','Accounts')=>url('configs/account/all'),
        $model->name,
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Account Config'), 'url'=>array('create')),
    array('id'=>'update','title'=>Sii::t('sii','Update Account Config'), 'url'=>array('update', 'id'=>$model->id)),
);

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'  => get_class($model),
    'heading'=> array(
        'name'=> $model->name,
        'superscript'=> Sii::t('sii','Account: {id}',['{id}'=>$model->account_id]),
    ),
    'body'=>$this->widget('common.widgets.SDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'account_id',
                'category',
                //'name',
                array(
                    'name'=>'value',
                    'value'=>$model->displayValue(),
                    'type'=>'raw',
                ),
            ),
        ),true),
));
