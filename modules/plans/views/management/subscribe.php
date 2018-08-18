<?php
$this->breadcrumbs=[
    Sii::t('sii','Account')=>url('account/profile'),
    Sii::t('sii','Plans')=>url('plans'),
    Sii::t('sii','Subscribe'),
];

$this->menu=$this->getPageMenu($model);

$this->widget('common.widgets.spage.SPage', [
    'id'=>$this->modelType,
    'breadcrumbs' => $this->breadcrumbs,
    'menu' => $this->menu,
    'flash' => $this->modelType,
    'heading' => [
        'name'=> Sii::t('sii','Subscribe {plan}',['{plan}'=>$model->name]),
        'tag'=> $model->getStatusText(),
    ],
    'body'=>$this->renderPartial('_subscribe_body', ['model'=>$model],true),
    'sections'=>$this->getSectionsData($model),
]);
