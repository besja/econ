<?php  global $theme_path;  global $base_url; ?>
<div id="common-search" class="common-search">
    <form action="<?php print $base_url;?>/search" method="GET">
        <input class="common-search__input" type="search" value="" name="keys" id="search" placeholder="введите слово для поиска">
        <input class="common-search__submit" type="submit" value="">
        <input type="hidden" value="news" name="type"/>
        <span class="common-search__icon">
        	 <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/search.svg');?>
        </span>
    </form>
</div>