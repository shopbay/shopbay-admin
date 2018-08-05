<?php
$this->breadcrumbs=array(
	Sii::t('sii','Configs')=>array('index'),
	$model->name,
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Config'), 'url'=>array('create')),
    array('id'=>'update','title'=>Sii::t('sii','Update Config'), 'url'=>array('update', 'id'=>$model->id)),
);

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'  => get_class($model),
    'heading'=> array(
        'name'=> $model->name,
    ),
    'body'=>$this->widget('common.widgets.SDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
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
