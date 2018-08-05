<?php echo $this->htmlBodyBegin;?>

<?php if (isset($this->headerView)):?>
<div class="header-container">
    <?php $this->renderPartial($this->headerView);?>
</div>
<?php endif;?>

<div class="page-container">
    <?php if ($this->module!=null && $this->module->id!='rights')//by pass this for rights module
              echo $this->renderGlobalFlash();
    ?>
    <?php echo $content; ?>
</div>

<?php if (isset($this->footerView)):?>
<div class="footer-container">
    <a href="#" class="scrollup"><i class="fa fa-arrow-circle-up"></i></a>      
    <?php $this->renderPartial($this->footerView); ?>
</div>    
<?php endif;?>

<?php echo $this->htmlBodyEnd;?>
