<?php $this->widget($this->module->getClass('gridview'), array(
    'id'=>'plan_gridview',
    'dataProvider'=> $dataProvider,
    'columns'=>array(
        array(
            'name'=>'id',
            'htmlOptions'=>array('style'=>'text-align:center;'),
            'type'=>'html',
        ),
        array(
            'name'=>'name',
            'value'=>'CHtml::link($data[\'name\'],url(\'plan/view/\'.$data[\'id\']))',
            'htmlOptions'=>array('style'=>'text-align:center;'),
            'type'=>'html',
        ),
        array(
           'name'=>'type',
           'value'=>'Plan::getTypesDesc($data[\'type\'])',
           'htmlOptions'=>array('style'=>'text-align:center;'),
           'type'=>'html',
        ),    
        array(
           'name'=>'duration',
           'value'=>'$data[\'duration\'].\' \'.Sii::t(\'sii\',\'days\')',
           'htmlOptions'=>array('style'=>'text-align:center;'),
           'type'=>'html',
        ),    
        array(
           'name'=>'price',
           'value'=>'Plan::getRecurringsDesc($data[\'recurring\']).\' \'.$data[\'currency\'].\' \'.number_format($data[\'price\'],2)',
           'htmlOptions'=>array('style'=>'text-align:center;'),
           'type'=>'html',
        ),
        array(
            'name'=>'status',
            'htmlOptions'=>array('style'=>'text-align:center;width:10%'),
            'type'=>'html',
            'filter'=>false,
        ),        
    ),
)); 