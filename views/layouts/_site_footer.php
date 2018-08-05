<div class="lower_footer">
    <div class="copyright">
        <?php echo Sii::t('sii','Copyright &copy; 2015 - {year} {company}.',['{year}'=>date('Y'),'{company}'=>param('ORG_NAME')]);?>     
    </div>
</div>

<?php $this->renderPartial('common.views.version.index'); ?>

<?php
cs()->registerScript('footer','$(\'#language\').change(function (){$(\'#langform\').submit();});');
    

