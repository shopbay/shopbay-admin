<?php 
$this->widget('common.widgets.SDetailView', array(
    'data'=>$model,
    'columns'=>array(
        array(
            array('name'=>'slug','type'=>'raw','value'=>$model->url),
            array('name'=>'tagline','value'=>$model->displayLanguageValue('tagline',user()->getLocale())),
        ),
        array(
            array('name'=>'create_time','value'=>$model->formatDatetime($model->create_time,true)),
            array('name'=>'update_time','value'=>$model->formatDatetime($model->update_time,true)),
        ),
    ),
));

$this->renderPartial('_shop_aggregates',['model'=>$model]);