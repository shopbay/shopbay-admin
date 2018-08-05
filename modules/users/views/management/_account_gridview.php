<?php
$this->widget($this->getModule()->getClass('gridview'), array(
    'id'=>$scope,
    'dataProvider'=>$this->getDataProvider($scope, $searchModel),
    'viewOptionRoute'=>$viewOptionRoute,
    'columns'=>array(
        'id',
        'name',
        'email',
        'last_login_ip',
        array(
            'name'=>'last_login_time',
            'value'=>'$data->formatDateTime($data->last_login_time,true)',
            'htmlOptions'=>array('style'=>'text-align:center;width:12%'),
        ),
        array(
            'name'=>'create_time',
            'value'=>'$data->formatDateTime($data->create_time,true)',
            'htmlOptions'=>array('style'=>'text-align:center;width:12%'),
        ),
        array(
            'header'=>Sii::t('sii','Roles'),
            'value'=>'Helper::htmlList($data->roles)',
            'htmlOptions'=>array('style'=>'text-align:center;width:8%'),
            'type'=>'html',
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
                    'label'=>'<i class="fa fa-info-circle" title="'.Sii::t('sii','More information').'"></i>',
                    'imageUrl'=>false,
                    'url'=>'$data->viewUrl',
                ),
//                'subscription' => array(
//                    'label'=>Sii::t('sii','View Subscription'),
//                    'imageUrl'=>false,
//                    'url'=>'url(\'/users/subscription/index\',array(\'account\'=>$data->id))',
//                ),
//                'suspend' => array(
//                    'label'=>Sii::t('sii','Suspend'),
//                    'imageUrl'=>false,
//                    'url'=>'url(\'/users/management/suspend\',array(\'account\'=>$data->id))',
//                    'visible'=>'$data->isSuspendable()'
//                ),
//                'resume' => array(
//                    'label'=>Sii::t('sii','Resume'),
//                    'imageUrl'=>false,
//                    'url'=>'url(\'/users/management/resume\',array(\'account\'=>$data->id))',
//                    'visible'=>'$data->isSuspended()'
//                ),
            ),
//            'template'=>'{view} {subscription} {suspend} {resume}',
            'template'=>'{view}',
        ),
    ),
));