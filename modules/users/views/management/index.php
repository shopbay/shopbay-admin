<?php
$this->breadcrumbs = [
    Sii::t('sii','Users'),
];

$this->menu = [];

$this->spageindexWidget(array_merge(
    ['breadcrumbs'=>$this->breadcrumbs],
    ['menu'  => $this->menu],
    ['flash' => $this->modelType],
    ['hideHeading' => false],
    ['sidebars'=>$this->getPageFilterSidebarData()],
    $config));

