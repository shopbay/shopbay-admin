<?php 
$this->widget('common.widgets.SDetailView', array(
    'data'=>$model,
    'columns'=>array(
        array(
            array('name'=>'name','value'=> $model->name),
            array('name'=>'type','value'=> $model->typeDesc),
            array('name'=>Package::getParamsName(Package::$businessReady),'value'=>$model->getParam(Package::$businessReady)?Sii::t('sii','Yes'):Sii::t('sii','No')),
            array('name'=>Package::getParamsName(Package::$showPricing),'value'=>$model->getParam(Package::$showPricing)?Sii::t('sii','Yes'):Sii::t('sii','No')),
            array('name'=>Package::getParamsName(Package::$showButton),'value'=>$model->getParam(Package::$showButton)?Sii::t('sii','Yes'):Sii::t('sii','No')),
        ),
        array(
            array('name'=>'account_id','type'=>'raw','value'=>$model->account->getAvatar(Image::VERSION_XXSMALL).' '.$model->account->name,'visible'=>user()->hasRole(Role::ADMINISTRATOR)),
            array('name'=>'create_time','value'=>$model->formatDatetime($model->create_time,true)),
            array('name'=>'update_time','value'=>$model->formatDatetime($model->update_time,true)),
        ),
    ),
));
