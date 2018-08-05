<?php
$this->widget('common.widgets.SDetailView', [
    'data'=>$model,
    'columns'=>[
        [
            ['label'=>Sii::t('sii','Products'),'type'=>'raw','value'=>$this->getShopAssetSummary($model->id,'Product')],        
        ],
        [
            ['label'=>Sii::t('sii','Orders'),'type'=>'raw','value'=>$this->getShopSaleSummary($model->id,'Order')],        
            ['label'=>Sii::t('sii','Sold Items'),'type'=>'raw','value'=>$this->getShopSaleSummary($model->id,'Item')],        
        ],
        [
            ['label'=>Sii::t('sii','Payment Methods'),'type'=>'raw','value'=>$this->getShopAssetSummary($model->id,'PaymentMethod')],        
            ['label'=>Sii::t('sii','Shippings'),'type'=>'raw','value'=>$this->getShopAssetSummary($model->id,'Shipping')],        
            ['label'=>Sii::t('sii','Tax'),'type'=>'raw','value'=>$this->getShopAssetSummary($model->id,'Tax')],        
        ],
        [
            ['label'=>Sii::t('sii','Sale Campaigns'),'type'=>'raw','value'=>$this->getShopAssetSummary($model->id,'CampaignSale')],        
            ['label'=>Sii::t('sii','BGA Campaigns'),'type'=>'raw','value'=>$this->getShopAssetSummary($model->id,'CampaignBga')],        
            ['label'=>Sii::t('sii','Promocoe Campaigns'),'type'=>'raw','value'=>$this->getShopAssetSummary($model->id,'CampaignPromocode')],        
        ],        
    ],
]);
//
//$this->widget('common.widgets.SDetailView', [
//    'data'=>$model,
//    'columns'=>[
//        [
//            ['label'=>Sii::t('sii','Payment Method'),'type'=>'raw','value'=>$this->getPaymentMethodList($model->id,user()->getLocale(),false)],        
//        ],
//        [
//            ['label'=>Sii::t('sii','Shippings'),'type'=>'raw','value'=>$this->getShippingList($model->id,user()->getLocale(),false)],        
//        ],
//        [
//            ['label'=>Sii::t('sii','Tax'),'type'=>'raw','value'=>$this->getTaxList($model->id,user()->getLocale(),false)],        
//        ],
//        [
//            ['label'=>Sii::t('sii','Campaigns'),'type'=>'raw','value'=>$this->getCampaignList($model->id,user()->getLocale(),false)],
//        ],
//    ],
//]);