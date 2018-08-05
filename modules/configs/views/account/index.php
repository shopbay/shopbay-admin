<?php
$this->breadcrumbs=[
    Sii::t('sii','Configs')=>url('configs'),
    Sii::t('sii','Accounts'),
];

$this->menu=[
    ['id'=>'create','title'=>Sii::t('sii','Create Account Config'), 'url'=>['create']],
];

$this->widget('common.widgets.spage.SPage',[
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'heading'=> [
        'name'=> Sii::t('sii','Account Level Configs'),
    ],
    'body'=>$this->widget('common.widgets.SListView', [
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
    ],true),
]);
