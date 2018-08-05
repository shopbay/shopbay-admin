<?php $this->widget($this->getModule()->getClass('gridview'), array(
    'id'=>'plan_item_gridview',
    'dataProvider'=> $dataProvider,
    'columns'=>array(
//        array(
//            'name'=>'id',
//            'header'=>PlanItem::model()->getAttributeLabel('id'),
//            'htmlOptions'=>array('style'=>'text-align:center;'),
//            'type'=>'html',
//        ),
        array(
            'header'=>Sii::t('sii','Feature ID'),
            'value'=>'$data[\'featureId\']',
            'htmlOptions'=>array('style'=>'text-align:center;'),
            'type'=>'html',
        ),
        array(
            'header'=>Sii::t('sii','Feature Name'),
            'value'=>'$data[\'featureName\']',
            'htmlOptions'=>array('style'=>'text-align:center;'),
            'type'=>'html',
        ),
        array(
            'header'=>Sii::t('sii','Feature Group'),
            'value'=>'$data[\'featureGroup\']',
            'htmlOptions'=>array('style'=>'text-align:center;'),
            'type'=>'html',
        ),
    ),
)); 