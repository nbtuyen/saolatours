<?php
global $tmpl; 
$tmpl -> addStylesheet('style2','blocks/gallery/assets/css');
?>
<div class="title-customer">
    <a href="<?php echo URL_ROOT.'tin-tuc.html' ?>" class="block_title">
        <?php echo $title; ?>
    </a>

</div>
<div class="summary">
    <?php echo $summary ?>
</div>
<div class="clear"></div>
<div class='news_list cls '>
    
        <div class="news_list_left">
            We'll design a personalized plan for you--you decide where you go, how you travel, the pace, number of days, type of lodging experience, food and drink experience, and how you want to interact with your guide.
            <div class="button">
                <button>ABOUT OUR SERVICES
                    <div class="svg">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" ><defs><style>.cls-3{fill:white;stroke:white;stroke-linecap:round;stroke-linejoin:bevel;stroke-width:1.5px;}</style></defs><g id="ic-arrows-right"><line class="cls-3"  x1="4.15" y1="12" x2="19.85" y2="12"/><path class="cls-3" d="M15.45,16.78l4.11-4.11a1,1,0,0,0,0-1.41l-4-4"/></g></svg>
                    </div></button>
            </div>
        </div>
        <div class="news_list_right">
            <?php $i=0; foreach($list as $item){?>
            <?php echo set_image_webp($item->image,'medium',@$item->title,'lazy',1,''); ?>
                <?php }?>
        </div>

    
</div>

<div class="clear"></div>