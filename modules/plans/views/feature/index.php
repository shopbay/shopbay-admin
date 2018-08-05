<?php
$this->breadcrumbs=array(
	Sii::t('sii','Features'),
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Feature'), 'url'=>array('create')),
);

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'=>$this->id,
    'heading'=>array('name'=>Sii::t('sii','Features')),
    'body'=>$this->widget('common.widgets.SGridView', array(
            'id'=>'feature_grid',
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                'id',
                'group',
                'name',
                'params',
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}',
                ),
            ),
        ),true),
    ));
