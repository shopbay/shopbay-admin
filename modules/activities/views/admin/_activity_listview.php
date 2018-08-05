<?php
$this->renderView('recent',[
    'data'=>$data,
    'trimLength'=>isset($trimLength)?$trimLength:null,
]);
