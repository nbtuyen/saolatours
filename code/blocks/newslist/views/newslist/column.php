<?php
global $tmpl; 
$tmpl -> addStylesheet('column','blocks/newslist/assets/css');
?>

     <div class="title_ cls"><h2><a href="">Tin nổi bật</a></h2></div>
     <div class="clear"></div>
  <div class='news_list_body_column cls'>
      <?php 
      $Itemid = 4;
      for($i = 0; $i < count($list); $i ++ ){
        $item = $list[$i];
        $link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias."&Itemid=$Itemid");     
        ?>
        <div class='news-item'>
          <div class='news-item-inner cls'> 
              <figure>
                <a href='<?php echo $link;?>' title="<?php echo $item->title;?>">
                  <img src='<?php echo URL_ROOT.str_replace('/original/','/resized/',$item -> image)?>' alt="<?php echo $item -> title?>"/>
                </a>
              </figure>
              
                <div class="title"><a href='<?php echo $link;?>' title="<?php echo $item->title;?>"><?php echo get_word_by_length(80,$item->title);?></a></div> 
                <div class="date">
                  
<svg  x="0px" y="0px"
   width="20px" height="20px" viewBox="0 0 485.213 485.212" style="enable-background:new 0 0 485.213 485.212;"
   xml:space="preserve">
<g>
  <path d="M60.652,75.816V15.163C60.652,6.781,67.433,0,75.817,0c8.38,0,15.161,6.781,15.161,15.163v60.653
    c0,8.38-6.781,15.161-15.161,15.161C67.433,90.978,60.652,84.196,60.652,75.816z M318.424,90.978
    c8.378,0,15.163-6.781,15.163-15.161V15.163C333.587,6.781,326.802,0,318.424,0c-8.382,0-15.168,6.781-15.168,15.163v60.653
    C303.256,84.196,310.042,90.978,318.424,90.978z M485.212,363.906c0,66.996-54.312,121.307-121.303,121.307
    c-66.986,0-121.302-54.311-121.302-121.307c0-66.986,54.315-121.3,121.302-121.3C430.9,242.606,485.212,296.919,485.212,363.906z
     M454.89,363.906c0-50.161-40.81-90.976-90.98-90.976c-50.166,0-90.976,40.814-90.976,90.976c0,50.171,40.81,90.98,90.976,90.98
    C414.08,454.886,454.89,414.077,454.89,363.906z M121.305,181.955H60.652v60.651h60.653V181.955z M60.652,333.584h60.653V272.93
    H60.652V333.584z M151.629,242.606h60.654v-60.651h-60.654V242.606z M151.629,333.584h60.654V272.93h-60.654V333.584z
     M30.328,360.891V151.628h333.582v60.653h30.327V94c0-18.421-14.692-33.349-32.843-33.349h-12.647v15.166
    c0,16.701-13.596,30.325-30.322,30.325c-16.731,0-30.326-13.624-30.326-30.325V60.651H106.14v15.166
    c0,16.701-13.593,30.325-30.322,30.325c-16.733,0-30.327-13.624-30.327-30.325V60.651H32.859C14.707,60.651,0.001,75.579,0.001,94
    v266.892c0,18.36,14.706,33.346,32.858,33.346h179.424v-30.331H32.859C31.485,363.906,30.328,362.487,30.328,360.891z
     M303.256,242.606v-60.651h-60.648v60.651H303.256z M409.399,363.906h-45.49v-45.49c0-8.377-6.781-15.158-15.163-15.158
    s-15.159,6.781-15.159,15.158v60.658c0,8.378,6.777,15.163,15.159,15.163h60.653c8.382,0,15.163-6.785,15.163-15.163
    C424.562,370.692,417.781,363.906,409.399,363.906z"/>
</g>


</svg>

                  <?php echo date($item -> created_time,2); ?>
                </div> 
                <div class="summary">
                  <a href='<?php echo $link;?>' title="<?php echo $item->title;?>"><?php echo get_word_by_length(140,$item->summary);?></a></div> 
                  <div class="read-more">
                    <a href="<?php echo $link; ?>" title="Xem Thêm">X e m &nbsp&nbsp  t h ê m &nbsp&nbsp  &#8594</a>
                  </div>
                <div class='clear'></div>
          </div>
         </div>   
      <?php } ?>
  </div>
