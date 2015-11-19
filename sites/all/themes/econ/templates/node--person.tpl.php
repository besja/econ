

<?php if ($teaser) :?>
    <a href="<?php print url('node/'.$node->nid);?>" class="common-module staff-card row">
        <?php if (isset($node->field_image['und'][0]['uri'])):?>
            <?php 
            print theme('image_style', array('style_name' => 'portret240_grey', 
                'path' => $node->field_image['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array("class"=>"col-xs-4 col-sm-6 staff-card__image")));
            ?> 
        <?php endif;?>

        <div class="col-xs-6 staff-card__text">
            <div class="staff-card__name"><?php print $node->title;?></div>
            <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
            <div class="staff-card__job"><?php print $node->field_leadtext['und'][0]['value'];?></div>
            <?php endif;?>
            <?php if (isset($node->field_email['und'][0]['email'])):?>
            <div class="staff-card__email"><?php print $node->field_email['und'][0]['email'];?></div>
             <?php endif;?>
        </div>
    </a>
    
<?php else:?>

<div class="common-module row">
    <div class="col-xs-6  col-sm-3 col-md-3">
	  <?php if (isset($node->field_image['und'][0]['uri'])):?>
	        <?php 
	        print theme('image_style', array('style_name' => 'portret240', 
	        	'path' => $node->field_image['und'][0]['uri'], 'alt'=>$node->title));
	        ?> 
	  <?php endif;?>
    </div>
    <div class="col-xs-12 col-sm-9 col-md-8">
        <h1 class="page__title"><?php print $node->title;?></h1>
        <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
        <div class="page__lead">
        	<?php print $node->field_leadtext['und'][0]['value'];?>
        </div>
   		<?php endif;?>
    </div>
</div>
<table class="common-module common-table common-table--person">
    <tr class="common-table__row">
        <td class="common-table__cell common-table__cell--accent">
            <span class="common-table__cell--header">E-MAIL</span>
            <?php if (isset($node->field_email['und'][0]['email'])):?>
            <a href="mailto:<?php print $node->field_email['und'][0]['email'];?>"><?php print $node->field_email['und'][0]['email'];?></a>
             <?php endif;?>
        </td>
         <?php if (isset($node->field_web['und'][0]['value'])):?>
        <td class="common-table__cell common-table__cell--accent">
            <span class="common-table__cell--header">WEB</span>
            <a href="<?php print $node->field_web['und'][0]['value'];?>" target="_blank"><?php print $node->field_web['und'][0]['value'];?></a></td>
         <?php endif;?>    
         <?php if (isset($node->field_phone['und'][0]['value'])):?>
        <td class="common-table__cell common-table__cell--accent">
            <span class="common-table__cell--header">Телефон</span>
            <a href="tel:<?php print $node->field_phone['und'][0]['value'];?>"><?php print $node->field_phone['und'][0]['value'];?></a></td>
         <?php endif;?>   
    	<?php if (isset($node->field_address['und'][0]['value'])):?>
        <td class="common-table__cell">
            <span class="common-table__cell--header">АДРЕС</span>
            <?php print $node->field_address['und'][0]['value'];?> </td>
        <?php endif;?> 
    </tr>
</table>
<?php print render($content['body']);?>

<?php if (count($node->field_files)):?>
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

<?php $links = _econ_pages_load_structures($node);?> 
	<?php if ($links):?>
		 <div class="common-module common-tabs">
		 	<?php print $links;?>
		 </div>
	<?php endif;?>
<?php print l("Все персоналии", "people", array("attributes"=>array("class"=>array("common-module", "big-btn"))));?>
<?php endif;?>