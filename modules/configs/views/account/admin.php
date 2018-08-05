<?php
$this->breadcrumbs=array(
	Sii::t('sii','Configs')=>url('configs'),
	Sii::t('sii','Accounts')=>url('configs/account/all'),
	Sii::t('sii','Manage'),
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Account Config'), 'url'=>array('create')),
);

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'heading'=>array('name'=>Sii::t('sii','Manage Account {section} Configs',array('{section}'=>isset($model->category)?ucfirst($model->category):''))),
    'body'=>$this->widget('common.widgets.SGridView', array(
                'id'=>'configs_account_grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'ajaxUrl'=>isset($model->category)?url('configs/account/'.$model->category):url('configs/account/all'),
                'columns'=>array(
                    'id',
                    'account_id',
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
