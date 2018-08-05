<?php
$this->breadcrumbs=[
    Sii::t('sii','Shops Administration'),
];

$this->spageindexWidget(array_merge(
    ['breadcrumbs'=>$this->breadcrumbs],
    ['flash' => $this->id],
    ['description' => Sii::t('sii','Administer all shops.')],
    ['hideHeading' => false],
    ['sidebars'=>$this->getPageFilterSidebarData()],
    $config)
);
