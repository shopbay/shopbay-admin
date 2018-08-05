<?php echo $this->htmlBodyBegin;?>

<div class="header-container">
    <?php $this->renderPartial($this->headerView);?>
</div>
<div class="page-container">
    <?php if ($this->module!=null && $this->module->id!='rights')//by pass this for rights module
              echo $this->renderGlobalFlash();
    ?>
    <?php echo $content; ?>
</div>
<div class="footer-container">
    <a href="#" class="scrollup"><i class="fa fa-arrow-circle-up"></i></a>      
    <?php $this->renderPartial($this->footerView); ?>
</div>    

<?php echo $this->htmlBodyEnd;?>
