<?php
$this->widget('common.widgets.spage.SPage',[
    'breadcrumbs'=>[
        Sii::t('sii','Web Content'),
        $model->displayName(),
    ],
    'flash'=>$this->id,
    'heading'=>['name'=>$model->displayName()],
    'body'=>$this->renderPartial('_seo_form',['model'=>$model],true),
]);
