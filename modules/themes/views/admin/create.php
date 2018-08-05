<?php $this->getModule()->registerFormCssFile();?>
<?php
$this->breadcrumbs=[
    Sii::t('sii','Account')=>url('account/profile'),
    Sii::t('sii','Themes')=>url('themes/admin/index'),
    Sii::t('sii','Create'),
];
$this->menu=[];

$this->widget('common.widgets.spage.SPage', [
    'id'=>$this->modelType,
    'breadcrumbs' => $this->breadcrumbs,
    'menu' => $this->menu,
    'flash' => get_class($model),
    'heading' => [
        'name'=> Sii::t('sii','Create Theme'),
    ],
    'body'=>$this->renderPartial('_form', ['model'=>$model],true),
]);