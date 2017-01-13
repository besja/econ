
<div class="common-module person-card">
	<div class="row">
		<div class="col-xs-6 col-sm-4 person-card__image"><img alt="" src="<?php print image_style_url("portret_220", $content['field_pane_image']['#items'][0]['uri']);?>"></div>
		<div class="col-xs-12 col-sm-8">
			<h3 class="person-card__name"><?php print $content['title']['#value'];?></h3>
			<?php if (isset($content['field_pane_years'])):?>
			<div class="person-card__years"><?php print render($content['field_pane_years']['#items'][0]['safe_value']); ?></div>
			<?php endif;?>
			<?php if (isset($content['field_pane_subheader'])):?>
			<div class="person-card__lead"><?php print render($content['field_pane_subheader']['#items'][0]['safe_value']); ?></div>
			<?php endif;?>
		</div>
	</div>
	<?php if (isset($content['field_pane_text'])):?>
	<div class="person-card__text"><?php print render($content['field_pane_text']['#items'][0]['value']); ?></div>
	<?php endif;?>
</div>