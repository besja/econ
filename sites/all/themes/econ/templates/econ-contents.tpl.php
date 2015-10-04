<div class="common-module row">
	<?php $cols = ceil(count($data) / 2.0); ?>

	 <div class="col-xs-12 col-sm-6">
	 	<?php for ($i=0; $i<$cols; $i++):?>
			<a href="<?php print url($data[$i]['link']['link_path']);?>" class="cafedra">
			<?php if ($data[$i]['img_uri']):?>
			<?php 
				print theme('image_style', array('style_name' => 'thumb69x67', 
			'path' => $data[$i]['img_uri'], 'alt'=>$data[$i]['link']['link_title'], "attributes"=>array("class"=>"cafedra__image")));
			?> 
			<?php endif;?>
			<div class="cafedra__text"><?php print $data[$i]['link']['link_title'];?></div>
			</a>
        <?php endfor;?>

	 </div>
	 <div class="col-xs-12 col-sm-6">
	 	<?php for ($i=$cols; $i<count($data); $i++):?>
			<a href="<?php print url($data[$i]['link']['link_path']);?>" class="cafedra">
			<?php if ($data[$i]['img_uri']):?>
			<?php 
				print theme('image_style', array('style_name' => 'thumb69x67', 
			'path' => $data[$i]['img_uri'], 'alt'=>$data[$i]['link']['link_title'], "attributes"=>array("class"=>"cafedra__image")));
			?> 
			<?php endif;?>
			<div class="cafedra__text"><?php print $data[$i]['link']['link_title'];?></div>
			</a>
		<?php endfor;?>
	 </div>
</div>