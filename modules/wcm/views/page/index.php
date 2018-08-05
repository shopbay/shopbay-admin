<?php
$this->widget('common.widgets.spage.SPage',[
    'breadcrumbs'=>$this->getBreadcrumbs($subject),
    'flash'=>$this->id,
    'heading'=>['name'=>$this->getContentHeading($subject)],
    'body'=>$this->renderPartial('_body',['subject'=>$subject],true),
]);
