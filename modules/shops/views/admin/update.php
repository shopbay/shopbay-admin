<?php
$this->breadcrumbs=[
    Sii::t('sii','Shops Administration')=>url('shops'),
    Sii::t('sii','Update'),
];

$this->menu=$this->getPageMenu($model);

$this->widget('common.widgets.spage.SPage', [
    'id'=>$this->modelType,
    'breadcrumbs' => $this->breadcrumbs,
    'menu' => $this->menu,
    'flash' => get_class($model),
    'heading' => [
        'name'=> $model->parseName(user()->getLocale()),
        'image'=>CHtml::image($model->getImageOriginalUrl(),'',['style'=>'width:'.Image::VERSION_XSMALL.'px;']),
        'tag'=> $model->getStatusText(),
    ],
    'body'=>'@todo',
]);
