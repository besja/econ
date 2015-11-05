
<?php if ($teaser) :?>
    <a href="<?php print url('node/'.$node->nid);?>" class="cafedra">
        <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>
            <?php 
            print theme('image_style', array('style_name' => 'thumb69x67', 
                'path' => $node->field_leadimage['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array("class"=>"cafedra__image")));
            ?> 
        <?php endif;?>
        <div class="cafedra__text"><?php print $node->title;?></div>
    </a>

<?php else:?>


<?php if (isset($node->field_leadtext['und'][0]['value'])):?>
<div class="page__lead">
<?php print $node->field_leadtext['und'][0]['value'];?>
</div>
<?php endif;?>

<?php if (isset($node->field_show_content['und']) && $node->field_show_content['und'][0]['value'] == '1'):?>
<?php print _econ_pages_get_sublinks();?> 
<?php endif;?>
<?php print render($content['body']);?>


<?php if (isset($node->field_files) && count($node->field_files)):?>
    <h2>Файлы</h2>
	<div class="row">
		<?php foreach ($node->field_files['und'] as $file):?>
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

<?php if (isset($node->field_show_contact_form['und']) && $node->field_show_contact_form['und'][0]['value'] == '1'):?>
<?php  module_load_include('inc', 'contact', 'contact.pages');
      $form = drupal_get_form('contact_site_form');
      ?>
      <h2 class="page__subheader">Задать вопрос</h2>
<?php 
      print render($form); 
?>
<?php endif;?>
<?php endif;?>