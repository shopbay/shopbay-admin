<?php
$this->breadcrumbs=[
    Sii::t('sii','Account')=>url('account/profile'),
    Sii::t('sii','Themes')=>url('themes/admin/index'),
    Sii::t('sii','View'),
];

$this->menu=$this->getPageMenu($model);

$this->widget('common.widgets.spage.SPage', [
    'id'=>$this->modelType,
    'breadcrumbs' => $this->breadcrumbs,
    'menu' => $this->menu,
    'flash' => get_class($model),
    'heading' => [
        'name'=> $model->displayLanguageValue('name',user()->getLocale()),
        'tag'=> $model->getStatusText(),
    ],
    'body'=>$this->renderPartial('_view_body', ['model'=>$model],true),
]);