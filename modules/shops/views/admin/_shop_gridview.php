<?php $this->widget($this->getModule()->getClass('gridview'), array(
    'id'=>$scope,
    'dataProvider'=>$this->getDataProvider($scope, $searchModel),
    'viewOptionRoute'=>$viewOptionRoute,
    'htmlOptions'=>array('data-description'=>$pageDescription,'data-view-option'=>$viewOption),
    //'filter'=>$searchModel,
    'columns'=>array(
        'id',
        array(
            'class' =>$this->getModule()->getClass('imagecolumn'),
            'header'=>Shop::model()->getAttributeLabel('image'),
            'name' =>'imageOriginalUrl',
            'htmlOptions'=>array('style'=>'text-align:center;width:120px;'),
        ),
        array(
            'name'=>'name',
            'value'=>'$data->displayLanguageValue(\'name\',user()->getLocale())',
            'htmlOptions'=>array('style'=>'text-align:center;width:12%'),
        ),
//        'slug',                  
        'contact_person',
//        'contact_no',
//        'email',
        'timezone',
        'language',
        'currency',
//        'weight_unit',
        array(
            'name'=>'create_time',
            'value'=>'$data->formatDateTime($data->create_time,true)',
            'htmlOptions'=>array('style'=>'text-align:center;width:12%'),
        ),
        array(
            'name'=>'status',
            'value'=>'Process::getHtmlDisplayText($data->status)',
            'htmlOptions'=>array('style'=>'text-align:center;width:8%'),
            'type'=>'html',
        ),                      
        array(
            'class'=>'CButtonColumn',
            'buttons'=>array (
                'view' => array(
                    'label'=>'<i class="fa fa-info-circle" title="'.Sii::t('sii','More Information').'"></i>', 
                    'imageUrl'=>false,  
                    'url'=>'url(\'/shops/admin/view\',array(\'shop\'=>$data->id))', 
                ),                                    
                'update' => array(
                    'label'=>'<i class="fa fa-edit" title="'.Sii::t('sii','Update Shop').'"></i>', 
                    'imageUrl'=>false,  
                    'url'=>'url(\'/shops/admin/update\',array(\'shop\'=>$data->id))', 
                ),                                    
                'suspend' => array(
                    'label'=>Sii::t('sii','Suspend'),
                    'imageUrl'=>false,  
                    'url'=>'url(\'/shops/admin/suspend\',array(\'shop\'=>$data->id))', 
                    'visible'=>'$data->isSuspendable()'
                ),
                'resume' => array(
                    'label'=>Sii::t('sii','Resume'),
                    'imageUrl'=>false,  
                    'url'=>'url(\'/shops/admin/resume\',array(\'shop\'=>$data->id))', 
                    'visible'=>'$data->isSuspended()'
                ),
            ),
//            'template'=>'{view} {update} {suspend}{resume}',
            'template'=>'{view} {update}',
        ),
    ),
)); 