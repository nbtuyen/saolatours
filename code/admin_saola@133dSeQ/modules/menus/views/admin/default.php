<?php 
include_once '../libraries/tree/tree.php';
$list = Tree::indentRows($list);
$root_total = 0;
$root_last = 0;
$url = $_SERVER['REQUEST_URI'];
foreach ($list as $item){
	if(!@$item->parent_id){
		$root_total ++ ;
		$root_last = $item->id;
	}
}
?>
<ul class="nav" id="side-menu" >

    <?php 
    $num_child = array();
    $parant_close = 0;
    foreach ($list as $item){
      $class = '';
      $collapse = '';
      $icon = '';
      if($item->link){
       $link = trim($item->link);
       if(strpos($url,$link) !== false)
        $class .= ' actives ';
}else{
   $link = "javascript:void(0)";
   $collapse =  '<span class="fa arrow"></span>';
}
if($item->icon){
    $icon = '<i class="'.$item->icon.'"></i> ';
}
$has_child = '';
if($item->children > 0)
    $has_child = ' has-child';
if(!$item->parent_id){
    ?>
    <li>
        <a href="<?php echo $link; ?>" class="header <?php echo $class;?>" >
          <?php echo '<span class="icon">'.$icon.'</span>'; ?>
          <?php echo '<span class="text">'.FSText::_(trim($item->name)).'<span class="fa arrow"></span> </span>'; ?>

      </a>

  <?php }else{ ?>
    <li>
        <a href="<?php echo $link; ?>" class="<?php echo $class;?>" >
            <?php echo '<span class="icon">'.$icon.'</span>'; ?>
            <?php echo '<span class="text">'.FSText::_(trim($item->name)).$collapse.'</span>'; ?>

        </a>

    <?php } ?>
    <?php 
    $num_child[$item->id] = $item->children ;
    if($item->children  > 0)
       echo "<ul class='nav nav-second-level'  >";
   if(@$num_child[$item->parent_id] == 1){
       if($item->children > 0){
        $parant_close ++;
    }else{
        $parant_close ++;
        for($i = 0 ; $i < $parant_close; $i++){
         echo "</ul>";
     }
     $parant_close = 0;
     $num_child[$item->parent_id]--;
 }
 if(@$num_child[$item->parent_id] >= 1) 
    $num_child[$item->parent_id]--;
}	
if(isset($num_child[$item->parent_id] ) && ($num_child[$item->parent_id] == 1) )
   echo "</ul>";
if(isset($num_child[$item->parent_id]) && ($num_child[$item->parent_id] >= 1) )
   $num_child[$item->parent_id]--;
echo '</li>';
}
?>
</ul>
<script>


    $(function(){
        var date = new Date();
        var minutes = 60;
        date.setTime(date.getTime() + (minutes * 60 * 24));
        $(".navbar-toggle").click(function() {
            if ( $('.navbar-default').hasClass('navbar-small') == false ) {
                $.cookie('navbar_small', 'Navbar Small', { expires: date});
                $.removeCookie("navbar_default");
            }
            else {
                $.cookie('navbar_default', 'Navbar Dèault', { expires: date});
                $.removeCookie("navbar_small");
            }

        });
    });


    $(function() {
          if($.cookie('navbar_small') == null) {


          }else{
            $('.navbar-default.sidebar').addClass("navbar-small");
            $('#page-wrapper').addClass("page-wrapper-small");
        };

    });




    $( document ).ready(function() {
        $('.navbar-toggle').click(function(){
                if($('.navbar-default.sidebar').hasClass("navbar-small") == false) {
                 $('.navbar-default.sidebar').addClass("navbar-small");
                 $('#page-wrapper').addClass("page-wrapper-small");
             } 
             else {
                 $('.navbar-default.sidebar').removeClass("navbar-small"); 
                 $('#page-wrapper').removeClass("page-wrapper-small");  
             }
        });
        $('#side-menu a.actives').parent('li').parent('ul').addClass('in').attr('aria-expanded','true');
     });




   function myFunction() {
        // Declare variables
        var input, filter, ul, li, a, i;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("side-menu");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
