<?php if (count($items)):?>
	<div class="row">
		<?php foreach ($items as $file):?>
		<a href="<?php print file_create_url($file['uri']);?>" class="common-module download-module col-xs-12 col-sm-5">
            <i class="download-module__icon">
            	<?php  // global $theme_path; // не работает в этом шаблоне, хз почему ?>
            	<?php include(DRUPAL_ROOT."/sites/all/themes/econ/spbgu/app/img/icons/download.svg");?>
            </i>
		    <span class="download-module__text">
		    	<?php if (isset($file['description'])):?>
		    		<?php print $file['description'];?>
		    	<?php else:?>
		    		<?php print $file['filename'];?>
		    	<?php endif;?>
		    </span>
		</a>
		<?php endforeach;?>
	</div>
<?php endif;?>
