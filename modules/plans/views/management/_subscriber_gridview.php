<?php $this->widget($this->getModule()->getClass('gridview'), [
    'id'=>'subscriber_gridview',
    'dataProvider'=> $dataProvider,
    'columns'=>[
        [
            'name'=>'id',
            'htmlOptions'=>['style'=>'text-align:center;'],
            'type'=>'html',
        ],
        [
            'name'=>'subscription_no',
            'htmlOptions'=>['style'=>'text-align:center;'],
            'type'=>'html',
        ],
//        [
//            'name'=>'plan_id',
//            'value'=>'$data->getPlanName()',
//            'htmlOptions'=>['style'=>'text-align:center;'],
//            'type'=>'html',
//        ],
        [
            'name'=>'account.name',
            'header'=>Sii::t('sii','Subscriber'),
            'htmlOptions'=>['style'=>'text-align:center;'],
            'type'=>'html',
        ],
        [
            'name'=>'start_date',
            'htmlOptions'=>['style'=>'text-align:center;'],
            'type'=>'html',
        ],
        [
            'name'=>'end_date',
            'htmlOptions'=>['style'=>'text-align:center;'],
            'type'=>'html',
        ],        
//        [
//            'name'=>'shop_id',
//            'htmlOptions'=>['style'=>'text-align:center;'],
//            'type'=>'html',
//        ],
        [
            'name'=>'update_time',
            'value'=>'$data->account->formatDateTime($data->update_time,true)',
            'htmlOptions'=>['style'=>'text-align:center;'],
        ],
        [
            'name'=>'status',
            'value'=>'Helper::htmlColorText($data->getStatusText())',
            'htmlOptions'=>['style'=>'text-align:center;width:10%'],
            'type'=>'html',
            'filter'=>false,
        ], 
        [
            'class'=>'CButtonColumn',
            'buttons'=> [
                'unsubscribe' => [
                    'label'=>'<i class="fa fa-close" title="'.Sii::t('sii','Remove Subscription From Plan').'"></i>', 
                    'imageUrl'=>false,  
                    'visible'=>'$data->cancellable()', 
                    'click'=>'js:function(){if (!confirm("'.Sii::t('sii','Are you sure you want to remove Subscription ID').' "+$(this).parent().parent().children(\':first-child\').text()+" ?")) return false;}',  
                    'url'=>'url(\'plans/management/unsubscribe\',[\'id\'=>$data->id,\'subNo\'=>$data->subscription_no,\'planId\'=>$data->plan_id])', 
                ],                                    
            ],
            'template'=>'{unsubscribe}',
            'htmlOptions'=>['width'=>'8%'],
        ],        
    ],
]); 