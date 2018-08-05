<?php
$this->breadcrumbs=array(
	Sii::t('sii','Features')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
        Sii::t('sii','Update')
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Feature'), 'url'=>array('create')),
);

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'  => get_class($model),
    'heading'=> array(
        'name'=> $model->name,
    ),
    'body'=>$this->renderPartial('_form', array('model'=>$model),true),
));

