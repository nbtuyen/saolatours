<?php  	global $tmpl;
$tmpl -> addStylesheet('detail','modules/contents/assets/css');
FSFactory::include_class('fsstring');
$print = FSInput::get('print',0);
?>



<div class="news_detail">
    <!-- NEWS NAME-->   
    <h1 class='title' >
        <?php   echo $data -> title; ?>
    </h1>
    
    <!-- end NEWS NAME-->
        
    <!-- DATETIME -->
    <?php if(1==2){ ?>
    <div class="time_rate cls">
         <?php  include 'default_base_rated_fixed.php'; ?>
        <span class='news_time' ><?php echo date('d/m/Y',strtotime($data -> created_time)); ?> </span>
        <font class="hidden">-</font>
        <span class="hidden new_category"><?php   //echo $category->name; ?></span>

        <div class="share-news">
            <?php //include_once 'default_share.php'; ?>
        </div>
    </div>
    <?php } ?>
    
    <!-- end DATETIME-->
    
                                
        <!-- SUMMARY -->
    <?php if($data -> summary){?>
        <div class="summary"><?php echo $data -> summary; ?></div>
    <?php }?>
    
    <div class='description' >
    
        <?php 
            // insert quảng cáo
            
                echo $data -> content;
            
        ?>
    </div>
 
                   
    <br />

    <!--    TAGS    -->
        <?php include_once 'default_tags.php'; ?>

    
    <!--    RELATED -->
    
        <div class="mbl tab_content_right">
        </div>
    
</div>


<div class="col-right-detail-content">
    <?php if ($tmpl->count_block('col-right-detail-news')) { ?>
         <?php echo $tmpl->load_position('col-right-detail-news'); ?>
    <?php } ?>
</div>



<input type="hidden" value="<?php echo $data->id; ?>" name='news_id' id='news_id'  />

<div class="clear"></div>
    

<?php if ($tmpl->count_block('pos_news_detail_1')) { ?>
    <div class="pos_news_detail_1">        
        <?php echo $tmpl->load_position('pos_news_detail_1'); ?>
    </div>
<?php } ?>



<?php if ($tmpl->count_block('news_pos2')) { ?>
    <div class="news_pos2">
        <?php echo $tmpl->load_position('news_pos2'); ?>
    </div>
<?php } ?>
