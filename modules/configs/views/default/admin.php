<?php
$this->breadcrumbs=array(
	Sii::t('sii','Configs')=>array('index'),
	Sii::t('sii','Manage'),
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Config'), 'url'=>array('create')),
);

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'heading'=>array('name'=>Sii::t('sii','Manage {section} Configs',array('{section}'=>isset($model->category)?ucfirst($model->category):''))),
    'body'=>$this->widget('common.widgets.SGridView', array(
                'id'=>'configs_grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'ajaxUrl'=>isset($model->category)?url('configs/default/'.$model->category):url('configs/default/all'),
                'columns'=>array(
                    'id',
                    'category',
                    'name',
                    array(
                        'name'=>'value',
                        'value'=>'$data->displayValue()',
                        'type'=>'raw',
                        'htmlOptions'=>array('style'=>'text-align:center'),
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{view} {update}',
                    ),
                ),
        ),true),
    ));
