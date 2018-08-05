<span class="sitelogo">
    <?php echo l(app()->name,app()->urlManager->getHomeUrl()); ?>
    <span class="subscript rounded3"><?php echo param('APP_VERSION'); ?></span>
</span>
<?php 
$this->widget('AdminUserMenu',[
    'user'=>user(),
    'cssClass'=>'nav-menu',
    'offCanvas'=>false,
]);

if (!user()->isGuest){
    $this->widget('ext.mbmenu.MbMenu',[
        'encodeLabel'=>false,
        'items'=>user()->getOperationMenu(),
    ]);
}