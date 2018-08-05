<?php $this->getModule()->registerGridViewCssFile();?>
<?php
$this->breadcrumbs=array(
    Sii::t('sii','Account')=>url('account/profile'),
    Sii::t('sii','Packages'),
);

$this->menu=array(
    array('id'=>'create','title'=>Sii::t('sii','Create Package'),'subscript'=>Sii::t('sii','create'), 'url'=>array('create')),    
);
    
$this->spageindexWidget(array_merge(
    array('breadcrumbs'=>$this->breadcrumbs),
    array('menu'  => $this->menu),
    array('flash' => $this->modelType),
    array('hideHeading' => false),
    array('description' => Sii::t('sii','This lists all the packages you have created in the past.')),
    ['sidebars' => $this->getProfileSidebar()],
    $config));
