<?php
$this->breadcrumbs=array(
	Sii::t('sii','Configs')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
        Sii::t('sii','Update')
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Config'), 'url'=>array('create')),
    array('id'=>'view','title'=>Sii::t('sii','View Config'), 'url'=>array('view', 'id'=>$model->id)),
);

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'  => get_class($model),
    'heading'=> array(
        'name'=> $model->name,
    ),
    'body'=>$this->renderPartial('_form_update', array('model'=>$model),true),
));

