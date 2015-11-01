
<?php if ($teaser) :?>
    <div class="contacts__name">
    <?php print $node->title;?></div>
    <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
    <div class="contacts__job"><?php print $node->field_leadtext['und'][0]['value'];?></div>
    <?php endif;?>
    <div>
    <?php if (isset($node->field_working_hours['und'][0]['value'])):?>
    <div class="contacts__working_hours">
    <span class="common-table__cell--header">Часы приема</span>
    <?php print $node->field_working_hours['und'][0]['value'];?>
    </div>
    <?php endif;?>
    <table class="common-module common-table contacts__table">
    <tr class="common-table__row">
        <td class="common-table__cell common-table__cell--accent">
            <span class="common-table__cell--header">E-MAIL</span>
            <a href="mailto:<?php print $node->field_email['und'][0]['email'];?>"><?php print $node->field_email['und'][0]['email'];?></a></td> 
         <?php if (isset($node->field_phone['und'][0]['value'])):?>
        <td class="common-table__cell common-table__cell--accent">
            <span class="common-table__cell--header">Телефон</span>
            <a href="tel:<?php print $node->field_phone['und'][0]['value'];?>"><?php print $node->field_phone['und'][0]['value'];?></a></td>
         <?php endif;?>   
        <?php if (isset($node->field_address['und'][0]['value'])):?>
        <td class="common-table__cell">
            <span class="common-table__cell--header">Аудитория</span>
            <?php print $node->field_address['und'][0]['value'];?> </td>
        <?php endif;?> 
    </tr>
    </table>

<?php else:?>

<div class="common-module row">
    <div class="col-xs-12 col-sm-12 col-md-12">
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
        <?php if (isset($node->field_email['und'][0]['email'])):?>
        <td class="common-table__cell common-table__cell--accent">
            <span class="common-table__cell--header">E-MAIL</span>
            <a href="mailto:<?php print $node->field_email['und'][0]['email'];?>"><?php print $node->field_email['und'][0]['email'];?></a></td> 
        <?php endif;?>
         <?php if (isset($node->field_phone['und'][0]['value'])):?>
        <td class="common-table__cell common-table__cell--accent">
            <span class="common-table__cell--header">Телефон</span>
            <a href="tel:<?php print $node->field_phone['und'][0]['value'];?>"><?php print $node->field_phone['und'][0]['value'];?></a></td>
         <?php endif;?>   
    	<?php if (isset($node->field_address['und'][0]['value'])):?>
        <td class="common-table__cell">
            <span class="common-table__cell--header">Аудитория</span>
            <?php print $node->field_address['und'][0]['value'];?> </td>
        <?php endif;?> 
        <?php if (isset($node->field_working_hours['und'][0]['value'])):?>
        <td class="common-table__cell">
            <span class="common-table__cell--header">Приемные часы</span>
            <?php print $node->field_working_hours['und'][0]['value'];?> </td>
        <?php endif;?> 
    </tr>
</table>

<?php print l("Телефонный справочник", "fakultet/contacts/phones", array("attributes"=>array("class"=>array("common-module", "big-btn"))));?>
<?php endif;?>