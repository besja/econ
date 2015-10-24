  <?php global $theme_path; global $base_url;?>
  <div id="common-search" class="common-module common-search">
    <form action="<?php print url('searchsite');?>" method="GET">
        <input class="common-search__input" type="search" value="<?php if (isset($_GET['keys'])){ print $_GET['keys'];} else { ?><?php }?>" name="keys" id="search" placeholder="введите слово для поиска">
        <input class="common-search__submit" type="submit" name="op" value="submit">
        <input type="hidden" name="region" value="<?php if (isset($_GET['region'])){print $_GET['region'];} else {print 'all';}?>" />
        <span class="common-search__icon"><?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/search.svg');?></span>
    </form>
  </div>
  <div class="common-module common-tabs search-tabs">
      <a href="javascript:void(0)" data-id="all" class="common-tabs__tab">ВЕСЬ САЙТ</a>
      <a href="javascript:void(0)" data-id="news" class="common-tabs__tab">НОВОСТИ И СОБЫТИЯ</a>
      <a href="javascript:void(0)" data-id="notnews" class="common-tabs__tab">НЕ ИСКАТЬ В НОВОСТЯХ</a>
  </div>
  
  <?php if (!isset($build['search_results']['#markup'])):?>
  <h1 class="page__title">Результаты поиска</h1>

  <?php foreach ($build['search_results'] as $item):?>
  <div class="common-module">
    <h2><?php print $item['title'];?></h2>
    <p><?php print $item['snippet'];?></p>
    <a href="<?php print $item['link'];?>">Подробнее...</a>
    </p>
 </div>
  <?php endforeach;?>
<?php if (count($build['search_results']) == 0) :?>
  <p>Ничего не найдено.</p>
<?php endif;?>
  <?php endif;?>

  <?php print render($build['pager_pager']); ?>