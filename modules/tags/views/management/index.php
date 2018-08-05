<?php $this->getModule()->registerGridViewCssFile();?>
<?php
$this->breadcrumbs=[
    Sii::t('sii','Account')=>url('account/profile'),
    Sii::t('sii','Tags'),
];

$this->menu=[
    ['id'=>'create','title'=>Sii::t('sii','Create Tag'),'subscript'=>Sii::t('sii','create'), 'url'=>['create']],    
];
    
$this->spageindexWidget(array_merge(
    array('breadcrumbs'=>$this->breadcrumbs),
    array('menu'  => $this->menu),
    array('flash' => $this->modelType),
    array('hideHeading' => false),
    array('description' => Sii::t('sii','This lists all the tags you have created in the past.')),
    ['sidebars' => $this->getProfileSidebar()],
    $config));
