<?php  global $theme_path;  global $base_url; ?>
<div id="common-search" class="common-search">
    <form action="<?php print url('searchsite');?>" method="GET">
        <input class="common-search__input" type="search" value="" name="keys" id="search" placeholder="введите слово для поиска">
        <input class="common-search__submit" type="submit" value="">
        <input type="hidden" value="news" name="region"/>
        <span class="common-search__icon">
        	 <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/search.svg');?>
        </span>
    </form>
</div>