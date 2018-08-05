<?php
$this->breadcrumbs=[
    Sii::t('sii','Users')=>url('users'),
    Sii::t('sii','View'),
];

$this->menu=$this->getPageMenu($model);

$this->widget('common.widgets.spage.SPage', [
    'id'=>$this->modelType,
    'breadcrumbs' => $this->breadcrumbs,
    'menu' => $this->menu,
    'flash' => get_class($model),
    'heading' => [
        'name'=> $model->name,
        'image'=> $model->getAvatar(Image::VERSION_XXSMALL),
        'tag'=> $model->getStatusText(),
    ],
    'body'=>$this->renderPartial('_view_body', ['model'=>$model],true),
    'sections'=>$this->getSectionsData($model),
]);
