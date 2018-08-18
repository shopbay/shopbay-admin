<?php
$this->breadcrumbs = [
    Sii::t('sii','Admin Users'),
];

$this->spageindexWidget(array_merge(
    ['breadcrumbs'=>$this->breadcrumbs],
    ['flash' => $this->modelType],
    ['hideHeading' => false],
    ['sidebars'=>$this->getPageFilterSidebarData()],
    $config));

