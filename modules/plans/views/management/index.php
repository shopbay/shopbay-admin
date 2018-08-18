<?php $this->getModule()->registerGridViewCssFile();?>
<?php
$this->breadcrumbs=[
    Sii::t('sii','Account')=>url('account/profile'),
    Sii::t('sii','Plans'),
];

$this->menu=[
    ['id'=>'create','title'=>Sii::t('sii','Create Plan'),'subscript'=>Sii::t('sii','create'), 'url'=>['create']],    
];
    
$this->spageindexWidget(array_merge(
    ['breadcrumbs'=>$this->breadcrumbs],
    ['menu'  => $this->menu],
    ['flash' => $this->modelType],
    ['hideHeading' => false],
    ['description' => Sii::t('sii','This lists all the plans you have created in the past.')],
    ['sidebars' => $this->getProfileSidebar()],
    $config));
