<?php
$this->breadcrumbs=array(
    Sii::t('sii','Admin Users')=>url('users/admin'),
    Sii::t('sii','Create'),
);
$this->menu=array();

$this->widget('common.widgets.spage.SPage', array(
    'id'=>$this->modelType,
    'breadcrumbs' => $this->breadcrumbs,
    'menu' => $this->menu,
    'flash' => get_class($model),
    'heading' => array(
        'name'=> Sii::t('sii','Create Admin User'),
    ),
    'body'=>$this->renderPartial('_form', array('model'=>$model),true),
));