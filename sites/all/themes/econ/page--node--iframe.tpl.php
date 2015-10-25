<?php global $theme_path; global $language; global $base_url; ?>
<header>
<div class="wrapper">
    <div class="container abiturient">
        <div class="row">
        <a href="<?php print $base_url.'/'.$language->language;?>" class="col-xs-12 col-sm-6 col-md-6 abiturient__logo">
            <div class="header-econ__logo"> <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/common/logo.svg');?></div>
            <div class="header-econ__title uppercase">Экономический<br>Факультет</div>
        </a>
        <a href="<?php print url('node/'.arg(1));?>" class="col-xs-6 col-sm-3 col-md-3 big-btn">ВЕРНУТЬСЯ НА <br>САЙТ ФАКУЛЬТЕТА</a>
        <a href="#" class="col-xs-6 col-sm-3 col-md-3 big-btn">ЗАДАТЬ <br>ВОПРОС</a>
        </div>
     </div>
</div>
</header>
<div class="wrapper">

    <?php if (arg(0)=='node' && is_numeric(arg(1))) {
        $node = node_load(arg(1));
        if (isset($node->field_web['und'])) {
    ?>
        <iframe frameborder=0 height=2400px width=100% scrolling=no src='<?php print $node->field_web['und'][0]['value'];?>'>
    <?php
        }
    }
    ?>
</div>
