<?php
$this->breadcrumbs=[
	Sii::t('sii','Configs')=>['index'],
	Sii::t('sii','Shop Plans')=>url('configs/shopplan'),
	$model->id,
        Sii::t('sii','Update')
];

$this->menu=[];

$this->widget('common.widgets.spage.SPage',[
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'  => get_class($model),
    'heading'=> [
        'name'=> 'Update Shop Subscription Plan',
    ],
    'body'=>$this->renderPartial('_form_update', ['model'=>$model],true),
]);

