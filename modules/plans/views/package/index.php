<?php $this->getModule()->registerGridViewCssFile();?>
<?php
$this->breadcrumbs=[
    Sii::t('sii','Account')=>url('account/profile'),
    Sii::t('sii','Packages'),
];

$this->menu=[
    ['id'=>'create','title'=>Sii::t('sii','Create Package'),'subscript'=>Sii::t('sii','create'), 'url'=>['create']],    
];
    
$this->spageindexWidget(array_merge(
    ['breadcrumbs'=>$this->breadcrumbs],
    ['menu'  => $this->menu],
    ['flash' => $this->modelType],
    ['hideHeading' => false],
    ['description' => Sii::t('sii','This lists all the packages you have created in the past.')],
    ['sidebars' => $this->getProfileSidebar()],
    $config));
