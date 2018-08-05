<?php $this->widget($this->getModule()->getClass('gridview'), array(
    'id'=>'user_shops',
    'dataProvider'=>$dataProvider,
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
    ),
)); 