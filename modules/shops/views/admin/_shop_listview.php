<?php
$this->widget('common.widgets.SDetailView', array(
    'data'=>$data,
    'htmlOptions'=>array('id'=>'shop_list','class'=>'list-box float-image'),
    'attributes'=>array(
        array(
            'type'=>'raw',
            'template'=>'<div class="status">{value}</div>',
            'value'=>Helper::htmlColorText($data->getStatusText(),false),
        ),
        array(
            'type'=>'raw',
            'template'=>'<div class="image">{value}</div>',
            'value'=>$data->getImageThumbnail(Image::VERSION_ORIGINAL,array('style'=>'width:'.Image::VERSION_XSMALL.'px;')),
        ),
        array(
            'type'=>'raw',
            'template'=>'{value}',
            'value'=>$this->widget('common.widgets.SDetailView', array(
                'data'=>$data,
                'htmlOptions'=>array('class'=>'data'),
                'attributes'=>array(
                    array(
                        'type'=>'raw',
                        'template'=>'<div class="heading-element">{value}</div>',
                        'value'=>CHtml::link(CHtml::encode($data->parseName(user()->getLocale())), url('/shops/admin/view',array('shop'=>$data->id))),
                    ),
                    array(
                        'type'=>'raw',
                        'template'=>'<div class="element">{value}</div>',
                        'value'=>'<strong>'.CHtml::encode($data->getAttributeLabel('timezone')).'</strong>'.
                                 CHtml::encode(SLocale::getTimeZones($data->timezone)),
                    ),          
                    array(
                        'type'=>'raw',
                        'template'=>'<div class="element">{value}</div>',
                        'value'=>'<strong>'.CHtml::encode($data->getAttributeLabel('currency')).'</strong>'.
                                 CHtml::encode(SLocale::getCurrencies($data->currency)),
                    ),          
                    array(
                        'type'=>'raw',
                        'template'=>'<div class="element">{value}</div>',
                        'value'=>'<strong>'.CHtml::encode($data->getAttributeLabel('contact_person')).'</strong>'.
                                 CHtml::encode($data->contact_person),
                    ),          
                    
                ),
            ),true),
        ),                
    ),
));