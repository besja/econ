
<div class="common-module common-tabs">
    <a href="<?php print url('fakultet/contacts');?>" class="common-tabs__tab common-tabs__tab--big-text current">Местоположение</a>
    <a href="<?php print url('fakultet/contacts/phones');?>" class="common-tabs__tab common-tabs__tab--big-text">Телефонный справочник</a>
</div>
<h1 class="page__title">Местоположение</h1>
<?php //drupal_set_message("<pre>".print_r($node, 1)."</pre>");?>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBgdGn29qAPJM_dqsBuZq1H-sr1klmy8Z8&sensor=false&extension=.js'></script>
<div id='embedded-map' class=""></div>
<a href="http://map.econ.spbu.ru/locations.php?action=search" target="_blank" class="common-module big-btn big-gap">Карта факультета</a>


<div id="fac-place_1" class="fac-place">
<h2>Корпус на Чайковского</h2>
<p>191123, Санкт-Петербург, ул. Чайковского, 62</p>
<?php if (count($node->field_contacts_gallery1)):?> 
<div class="common-module common-slider">
    <div class="common-slider__control common-slider__control--next">
      <i><?php include(DRUPAL_ROOT."/sites/all/themes/econ/spbgu/app/img/icons/common-slider__arrow.svg");?></i>
    </div>
    <div class="common-slider__control common-slider__control--prev">
      <i><?php include(DRUPAL_ROOT."/sites/all/themes/econ/spbgu/app/img/icons/common-slider__arrow.svg");?></i>
    </div>
    <div id="slider-1" class="common-slider__slides owl-carousel">
      <?php foreach($node->field_contacts_gallery1['und'] as $image):?>
      <?php 
      $alt = '';
      $title = '';
      if (isset($image['alt'])) { $alt = $image['alt'];}
      if (isset($image['title'])) { $title = $image['title'];}
      ?>
      <div>
          <?php if (isset($image['uri'])):?>
              <?php 
              print theme('image_style', array('style_name' => 'slider', 
                  'path' => $image['uri'], 'alt'=>$alt));
              ?> 
          <?php endif;?>
          <div class="slide-meta">
              <div class="slide-meta__title"><?php print $alt;?></div>
              <div  class="slide-meta__name" ><?php print $title;?></div>
          </div>
      </div>
      <?php endforeach;?>
    </div>
    <div class="row common-slider__meta">
          <div class="col-xs-9 col-sm-10">
              <div class="common-slider__title"></div>
              <div class="common-slider__author"><span  class="common-slider__author__name" ></span></div>
          </div>
          <div class="col-xs-3 col-sm-2">
              <div class="common-slider__counter"><span class="common-slider__current-number"></span> / <span class="common-slider__total-slides"></span></div>
          </div>
    </div>
</div>
<?php endif;?>
</div>
<div id="fac-place_2" class="fac-place">
    <h2>Корпус на Радищева</h2>
    <p>191123, Санкт-Петербург, ул. Радищева, 39</p>
<?php if (count($node->field_contacts_gallery2)):?> 
<div class="common-module common-slider">
    <div class="common-slider__control common-slider__control--next">
      <i><?php include(DRUPAL_ROOT."/sites/all/themes/econ/spbgu/app/img/icons/common-slider__arrow.svg");?></i>
    </div>
    <div class="common-slider__control common-slider__control--prev">
      <i><?php include(DRUPAL_ROOT."/sites/all/themes/econ/spbgu/app/img/icons/common-slider__arrow.svg");?></i>
    </div>
    <div id="slider-1" class="common-slider__slides owl-carousel">
      <?php foreach($node->field_contacts_gallery2['und'] as $image):?>
      <?php 
      $alt = '';
      $title = '';
      if (isset($image['alt'])) { $alt = $image['alt'];}
      if (isset($image['title'])) { $title = $image['title'];}
      ?>
      <div>
          <?php if (isset($image['uri'])):?>
              <?php 
              print theme('image_style', array('style_name' => 'slider', 
                  'path' => $image['uri'], 'alt'=>$alt));
              ?> 
          <?php endif;?>
          <div class="slide-meta">
              <div class="slide-meta__title"><?php print $alt;?></div>
              <div  class="slide-meta__name" ><?php print $title;?></div>
          </div>
      </div>
      <?php endforeach;?>
    </div>
    <div class="row common-slider__meta">
          <div class="col-xs-9 col-sm-10">
              <div class="common-slider__title"></div>
              <div class="common-slider__author"><span  class="common-slider__author__name" ></span></div>
          </div>
          <div class="col-xs-3 col-sm-2">
              <div class="common-slider__counter"><span class="common-slider__current-number"></span> / <span class="common-slider__total-slides"></span></div>
          </div>
    </div>
</div>
<?php endif;?>
</div>
<div id="fac-place_3" class="fac-place">
    <h2>Корпус на Таврической</h2>
    <p>191123, Санкт-Петербург, ул. Радищева, 39</p>         
<?php if (count($node->field_contacts_gallery3)):?> 
<div class="common-module common-slider">
    <div class="common-slider__control common-slider__control--next">
      <i><?php include(DRUPAL_ROOT."/sites/all/themes/econ/spbgu/app/img/icons/common-slider__arrow.svg");?></i>
    </div>
    <div class="common-slider__control common-slider__control--prev">
      <i><?php include(DRUPAL_ROOT."/sites/all/themes/econ/spbgu/app/img/icons/common-slider__arrow.svg");?></i>
    </div>
    <div id="slider-1" class="common-slider__slides owl-carousel">
      <?php foreach($node->field_contacts_gallery3['und'] as $image):?>
      <?php 
      $alt = '';
      $title = '';
      if (isset($image['alt'])) { $alt = $image['alt'];}
      if (isset($image['title'])) { $title = $image['title'];}
      ?>
      <div>
          <?php if (isset($image['uri'])):?>
              <?php 
              print theme('image_style', array('style_name' => 'slider', 
                  'path' => $image['uri'], 'alt'=>$alt));
              ?> 
          <?php endif;?>
          <div class="slide-meta">
              <div class="slide-meta__title"><?php print $alt;?></div>
              <div  class="slide-meta__name" ><?php print $title;?></div>
          </div>
      </div>
      <?php endforeach;?>
    </div>
    <div class="row common-slider__meta">
          <div class="col-xs-9 col-sm-10">
              <div class="common-slider__title"></div>
              <div class="common-slider__author"><span  class="common-slider__author__name" ></span></div>
          </div>
          <div class="col-xs-3 col-sm-2">
              <div class="common-slider__counter"><span class="common-slider__current-number"></span> / <span class="common-slider__total-slides"></span></div>
          </div>
    </div>
</div>
<?php endif;?>      
</div>
<div class="contact">
  <?php print render($content['body']);?>
</div>
<?php if (count($node->field_files)):?>
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