<?php
$this->breadcrumbs=[
	Sii::t('sii','Configs'),
	Sii::t('sii','Shop Plans'),
];

$this->menu=[];

$this->widget('common.widgets.spage.SPage',[
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'heading'=>['name'=>Sii::t('sii','Shop Plan Configs')],
    'body'=>$this->widget('common.widgets.SGridView', [
                'id'=>'configs_grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'columns'=>[
                    'id',
                    'shop_id',
                    'subscription_id',
                    'subscription_no',
                    'plan_id',
                    'item_name',
                    'item_params',
                    [
                        'class'=>'CButtonColumn',
                        'template'=>'{update}',
                    ],
                ],
        ],true),
    ]);
