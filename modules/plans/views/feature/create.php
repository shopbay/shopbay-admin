<?php
$this->breadcrumbs=array(
	Sii::t('sii','Features')=>array('index'),
        Sii::t('sii','Create')
);

$this->menu=array();

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'  => get_class($model),
    'heading'=> array(
        'name'=> Sii::t('sii','Create Feature'),
    ),
    'body'=>$this->renderPartial('_form_create', array('model'=>$model),true),
));
