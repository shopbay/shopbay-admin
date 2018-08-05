<?php
$this->breadcrumbs=array(
	Sii::t('sii','Features')=>array('index'),
	$model->name,
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Feature'), 'url'=>array('create')),
    array('id'=>'update','title'=>Sii::t('sii','Update Feature'), 'url'=>array('update', 'id'=>$model->id)),
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
                'group',
                'name',
                array(
                    'name'=>'params',
                    'value'=>$this->parseFeatureParams($model),
                    'type'=>'raw',
                ),
            ),
        ),true),
));
