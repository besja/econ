<?php  global $theme_path;  global $base_url; ?>
<?php
    $shortcuts = menu_build_tree("menu-shortcatmenu");
    $mainmenu = menu_build_tree("menu-econ-mainmenu");
?>
<?php 
    print _econ_pages_menu_block_view("menu_mobile_block"); 
?>
<div id="wrapper" class="wrapper">
    <header class="header">
        <div class="container">
            <div class="row">
                <!--[if lt IE 8]>
                    <p class="browserupgrade">Вы используете слишком <strong>старый</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">смените его</a> и все станет красиво.</p>
                <![endif]-->
                <div class="header-spbgu col-xs-3 col-sm-2">
                    <div class="header-spbgu__slide">
                        <div class="header-spbgu__frontside">
                            <div class="header-spbgu__gerb">
                                <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/common/gerb.svg');?>
                            </div>
                            <div class="header-spbgu__title">
                                <span class="visible-xs visible-sm">СПБГУ</span>
                                <span class="hidden-xs hidden-sm">САНКТ-ПЕТЕРБУРГСКИЙ<br>ГОСУДАРСТВЕННЫЙ<br> УНИВЕРСИТЕТ</span>
                            </div>
                        </div>
                        <a href="#" class="header-spbgu__backside">
                            <div class="header-spbgu__arrow">
                                 <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/common/arrow.svg');?>
                             </div>
                            <div class="header-spbgu__title">
                                <span class="visible-xs visible-sm">ПОРТАЛ <br>СПБГУ</span>
                                <span class="hidden-xs hidden-sm">ПЕРЕЙТИ НА <br>ПОРТАЛ СПБГУ</span>
                            </div>
                        </a>
                    </div>
                </div>
              <div class="col-xs-9 col-sm-10">
                    <div class="row">
                        <div class="header-econ cf col-xs-12 col-md-5">
                            <a href="<?php print $base_url;?>"> <!-- линк на главную -->
                                <div class="header-econ__logo">
                                    <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/common/logo.svg');?>
                                 </div>
                                <div class="header-econ__title uppercase">Экономический<br>Факультет</div>
                            </a>
                        </div>
                        <div class="shortcuts-menu col-xs-12 col-md-7 hidden-xs hidden-sm">
 
                            <ul class="shortcuts-menu__list cf">
                                 <?php foreach ($shortcuts as $m):?>
                                     <li class="shortcuts-menu__item">
                                        <?php 
                                            print l($m['link']['title'], 
                                            $m['link']['link_path'], 
                                            array("attributes"=>array("class"=>array("shortcuts-menu__link"))));
                                        ?>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    <div class="row">

                        <div id="main-menu" class="main-menu col-md-10 visible-md visible-lg">
                            <ul role="tablist" class="main-menu__list cf">
                                <?php $i = 1;?>
                                <?php foreach ($mainmenu as $m):?>
                                <li <?php if ($i==1):?> data-tab="1" <?php endif;?> class="main-menu__item 
                                    <?php if ($m['link']['in_active_trail']):?> current <?php endif;?>">
                                    <a href="#main-menu-<?php print $i;?>" role="tab" id="main-menu-tab-<?php print $i;?>" 
                                        data-toggle="tab" 
                                        aria-controls="#main-menu-<?php print $i;?>" 
                                        aria-expanded="true" 
                                        class="main-menu__link">
                                            <?php print $m['link']['title'];?>
                                    </a>
                                 </li>
                                <?php $i++;?>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <div id="header-search" class="header-search">
                            <form action="/">
                                <input class="header-search__input" type="search" value="" name="search" id="search" placeholder="введите слово для поиска">
                                <input class="header-search__submit" type="submit" value="">
                                <span class="header-search__icon">
                                    <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/search.svg');?>
                                </span>
                            </form>
                        </div>
                        <div class="header-lang"><a class="header-lang__link" href="#">EN</a></div>
                        <a id="mobile-menu-button" href="#" class="mobile-menu-button visible-xs visible-sm" data-effect="st-effect-4">
                             <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/burger.svg');?>
                         </a>
                    </div>
                </div>
            </div>
            <div id="full-menu" class="row tab-content full-menu">
                <?php $i = 1;?>
                 <?php foreach ($mainmenu as $m):?>
                    <?php 

                        $children = array_values($m['below']);
                        ?>                   
                        <div id="main-menu-<?php print $i;?>"  role="tabpanel" 
                            class="full-menu__tab-pane tab-pane fade active">
                        <div class="col-md-7">
                            <div class="row">
                                <?php if (count($children)):?>
                                            <?php 
                                                $total = 7;
                                                $colums = ceil(count($children)/$total);
                                            ?>
                                                <?php for ($j=0; $j<$colums; $j++):?>
                                                    <div class="col-md-6">
                                                        <ul class="full-menu__list">
                                                            <?php for ($k=$total*$j; $k<$total*$j + $total ; $k++) :?>
                                                                <?php if (isset($children[$k])):?>
                                                                <li class="full-menu__item">
                                                                    <?php print l($children[$k]['link']['link_title'],
                                                                     $children[$k]['link']['link_path'], 
                                                                     array("attributes"=>array("class"=>array("full-menu__item__link"))));?>
                                                                </li>
                                                                <?php endif;?>
                                                            <?php endfor;?>
                                                        </ul>
                                                    </div>
                                                <?php endfor;?>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php if ($page['header']):?>
                            <div class="full-menu__featured col-md-5">
                                <div class="row">
                                  <?php 
                                    print _econ_pages_render_featured($i);
                                  ?>
                                </div>
                            </div>
                        <?php endif;?>
                        </div>

                 <?php $i++;?>
                <?php endforeach;?>

            </div>
        </div>
    </header>
    <div class="container main-content"> 
        <div class="row">
            <!--  end header --> 
            <div class="container <?php print _econ_page_class();?>">
                <div class="row">
                    <main class="col-sm-12 col-md-9 no-paddings">


                        <!-- breadcumbs -->
                        <!-- main img -->
                        <?php if ($breadcrumb): ?>
                          <?php print $breadcrumb; ?>
                        <?php endif; ?>
                        <?php if ($leadimage):?>
                        <div class="page__main-image">
                           <?php print $leadimage;?>
                        </div>
                        <?php endif;?>
                        <div class="page__content">
                            <?php if ($tabs): ?>
                            <div class="tabs drupal-tabs">
                                    <?php print render($tabs); ?>
                            </div>
                            <?php endif; ?>
                            <h1 class="page__title"><?php print $title;?></h1>
                            <?php print $messages; ?>
                            <?php print render($page['content']); ?>
                        </div>
                           <!-- news search --> 
                            <?php if ($page['bottom']):?>
                                <?php print render($page['bottom']);?>
                            <?php endif;?>
                           <!-- news search --> 
                    </main>
                   <!-- sidebar --> 
                    <?php if ($page['sidebar']):?>
                        <?php print render($page['sidebar']);?>
                    <?php endif;?>
                   <!-- end sidebar --> 
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- / container main-content -->

    <footer class="footer">
        <div class="container footer__container">
            <div class="row">
                <div class="col-xs-12 col-md-5">
                    <div class="footer__gerb">
                        <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/common/gerb.svg');?>
                    </div>
                    <h3 class="footer__header">
                        САНКТ-ПЕТЕРБУРГСКИЙ <br>ГОСУДАРСТВЕННЫЙ УНИВЕРСИТЕТ
                    </h3>
                    <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-5">
                      <ul class="footer__menu">
                        <li class="footer__menu__item"><a href="#" class="li footer__menu__link">полезные ссылки</a></li>
                        <li class="footer__menu__item"><a href="#" class="li footer__menu__link">программа развития спбгу</a></li>
                        <li class="footer__menu__item"><a href="#" class="li footer__menu__link">виртуальная приемная спбгу</a></li>
                      </ul>
                    </div>
                    <div class="col-xs-12 col-md-12 col-sm-7">
                      <ul class="footer__menu">
                        <li class="footer__menu__item"><a href="#" class="li footer__menu__link">бесплатная юридическая консультация</a></li>
                        <li class="footer__menu__item"><a href="#" class="li footer__menu__link">бесплатная психологическая помощь</a></li>
                        <li class="footer__menu__item"><a href="#" class="li footer__menu__link">центр защиты прав абитуриентов</a></li>
                      </ul>
                    </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7">
                  <div class="footer__econ-logo">
                        <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/common/logo.svg');?>
                  </div>
                  <div class="row">
                        <div class="col-xs-12 col-md-4 col-sm-4">
                            <h3 class="footer__header footer__header--econ">ЭКОНОМИЧЕСКИЙ <br>ФАКУЛЬТЕТ</h3>
                            <ul class="footer__menu">
                                 <?php foreach ($mainmenu as $m):?>
                                  <li class="footer__menu__item">
                                    <?php print l($m['link']['title'], $m['link']['link_path'], array("attributes"=>array("class"=>array("li footer__menu__link"))));?>
                                   </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-md-4 col-sm-4">
                            <h3 class="footer__header">ФАКУЛЬТЕТ В <br>СОЦИАЛЬНЫХ СЕТЯХ</h3>
                            <ul class="footer__menu">
                                <li class="footer__menu__item"><a href="#" class="li footer__menu__link">vkontakte</a></li>
                                <li class="footer__menu__item"><a href="#" class="li footer__menu__link">facebook</a></li>
                                <li class="footer__menu__item"><a href="#" class="li footer__menu__link">youtube</a></li>
                                <li class="footer__menu__item"><a href="#" class="li footer__menu__link">twitter</a></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-md-4 col-sm-4">
                            <h3 class="footer__header">КОНТАКТНАЯ <br>ИНФОРМАЦИЯ</h3>
                            <ul class="footer__menu">
                                <li class="footer__menu__item"><a href="tel:+78122754966" class="li footer__menu__link">ОТДЕЛ ПО СВЯЗЯМ С ОБЩЕСТВЕННОСТЬЮ <br>+7 (812) 275 49 66</a></li>
                                <li class="footer__menu__item"><a href="tel:+78123204050" class="li footer__menu__link">ПРИЕМНАЯ ДЕКАНА <br>+7 (812) 320 40 50</a></li>
                                <li class="footer__menu__item"><a href="tel:+78122720803" class="li footer__menu__link">УЧЕБНЫЙ ОТДЕЛ <br>+7 (812) 272 08 03</a></li>
                                <li class="footer__menu__item"><a href="#" class="li footer__menu__link">АДРЕСА ФАКУЛЬТЕТА</a></li>
                                <li class="footer__menu__item"><a href="#" class="li footer__menu__link">BLACKBOARD</a></li>
                            </ul>
                        </div>
                </div>
                </div>
            </div>
            <div class="row footer__copy">
                <div class="col-xs-12 col-md-5">
                  <!-- <div class="footer__copy"> -->
                  © 2015 Санкт-Петербургский государственный университет
                  <!-- </div> -->
                </div>
                <div class="col-xs-12 col-md-6">
                  <!-- <div class=""> -->
                    Сделано <a href="http://whitescape.com/" class="footer__copy--whitescape" target="_blank">Whitescape</a> в сотрудничестве с СПбГУ
                  <!-- </div> -->
                </div>
            </div>
            <!-- portal -->
            <div class="spbgu-portal">
                <div class="spbgu-portal__label">Портал СПбГУ <i><?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/accordion-arrow.svg');?></i></div>
                   <div class="spbgu-portal__accordion scrollable" id="spbgu-portal__accordion">
                    <div class="spbgu-portal__panel panel">
                        <h4 class="spbgu-portal__header">
                            <a data-toggle="collapse" data-parent="#spbgu-portal__accordion" aria-expanded="true" href="#spbgu-portal__collapse-1">Основные разделы 
                                <i>
                                    <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/accordion-arrow.svg');?></i>
                            </a>
                        </h4>
                        <div id="spbgu-portal__collapse-1" class=" collapse">
                            <ul class="spbgu-portal__list">
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Руководство</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">История факультета</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Документы</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Телефоны и адреса</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="spbgu-portal__panel panel">
                        <h4 class="spbgu-portal__header">
                            <a data-toggle="collapse" data-parent="#spbgu-portal__accordion" href="#spbgu-portal__collapse-2">Выберете подразделения 
                                <i><?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/accordion-arrow.svg');?></i></a>
                        </h4>
                        <div id="spbgu-portal__collapse-2" class="collapse">
                            <ul class="spbgu-portal__list">
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Биологический</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Восточный</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Высшая школа менеджмента</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Институт наук о Земле</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Журналистики и массовых коммуникаций</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Искусств</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Институт истории</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Математико-механический</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Медицинский</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Международных отношений</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Политологии</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Прикладной математики - процессов управления</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Психологии</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Свободных искусств и наук</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Социологии</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Стоматологии и медицинских технологий</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Физический</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Филологический</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Институт философии</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Институт химии</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Экономический</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Юридический</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Академическая гимназия имени Д.К. Фаддеева СПбГУ</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Факультет Военного обучения</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Общеуниверситетская кафедpа физической культуpы и споpта</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Медицинский колледж</a></li>
                                <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Колледж физической культуры и спорта, экономики и технологии</a></li>
                            </ul>
                        </div>
                    </div>
                    <ul class="spbgu-portal__list">
                        <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Новости</a></li>
                        <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Анонсы</a></li>
                        <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Виртуальная приемная</a></li>
                        <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Сми о нас </a></li>
                        <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Ректорские совещания</a></li>
                        <li class="spbgu-portal__item"><a href="#" class="spbgu-portal__link">Видео</a></li>
                    </ul>
                    <div class="spbgu-portal__search">
                        <form action="/">
                            <input class="spbgu-portal__search__input" type="search" value="" name="search" id="search" placeholder="введите слово для поиска">
                            <input class="spbgu-portal__search__submit" type="submit" value="">
                            <span class="spbgu-portal__search__icon">
                                <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/search.svg');?>
                            </span>
                        </form>
                    </div>
                    <ul class="spbgu-portal__social-links">
                        <li class="spbgu-portal__social-item"><a href="#">MAIL.SPBU.RU</a></li>
                        <li class="spbgu-portal__social-item"><a href="#">TWITTER</a></li>
                        <li class="spbgu-portal__social-item"><a href="#">YOUTUBE</a></li>
                        <li class="spbgu-portal__social-item"><a href="#">RSS</a></li>
                    </ul>
                </div>
            </div>        
        </div>
    </footer>
</div> <!-- /wrapper /st-container-->
