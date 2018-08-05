<?php
$this->breadcrumbs=[
   Sii::t('sii','Configs'),
];

$this->menu=[
    ['id'=>'create','title'=>Sii::t('sii','Create Config'), 'url'=>['create']],
];

$this->widget('common.widgets.spage.SPage',[
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'heading'=> [
        'name'=> Sii::t('sii','Default Configs'),
    ],
    'body'=>$this->widget('common.widgets.SListView', [
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
    ],true),
]);
