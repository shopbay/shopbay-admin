<?php
$this->breadcrumbs=array(
	Sii::t('sii','Configs')=>url('configs'),
	Sii::t('sii','Accounts')=>url('configs/account/all'),
        Sii::t('sii','Create')
);

$this->menu=array();

$this->widget('common.widgets.spage.SPage',array(
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'  => get_class($model),
    'heading'=> array(
        'name'=> Sii::t('sii','Create Account Config'),
    ),
    'body'=>$this->renderPartial('_form', array('model'=>$model),true),
));
