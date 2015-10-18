<div class="row">
    <a href="<?php print $data[0]->url;?>" class="cafedra-big col-xs-12 col-sm-6 col-md-12 ">
        <?php if (isset($data[0]->uri)):?>
            <?php 
            print theme('image_style', array('style_name' => 'thumb292', 
                'path' => $data[0]->uri, 'alt'=>$data[0]->title, "attributes"=>array("class"=>"cafedra-big__image")));
            ?> 
        <?php endif;?>
        <div class="cafedra-big__text"><?php print $data[0]->title;?></div>
    </a>
    <?php if (count($data)>1):?>
        <div class="common-module col-xs-12 col-sm-6 col-md-12">
            <div class="row">
                <?php for ($i=1; $i<count($data); $i++):?>
                    <a href="<?php print $data[$i]->url;?>" class="cafedra col-xs-12">
                        <?php if (isset($data[$i]->uri)):?>
                            <?php 
                            print theme('image_style', array('style_name' => 'thumb69x67', 
                                'path' => $data[$i]->uri, 'alt'=>$data[$i]->title, "attributes"=>array("class"=>"cafedra__image")));
                            ?> 
                        <?php endif;?>
                        <div class="cafedra__text"><?php print $data[$i]->title;?></div>
                    </a>               
                <?php endfor;?>          
            </div>
        </div>
    <?php endif;?>
</div>