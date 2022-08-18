<?php $Itemid = FSInput::get('Itemid',1,'int');
$link = $_SERVER['REQUEST_URI'];
$link = URL_ROOT.str_replace('.amp','.html',$link);
$link = str_replace('.vn/','.vn',$link);
$tmpl -> addStylesheet('amp');
global $config;
echo $config['amp_analytics'];
?>



<!-- <h4>How can we help?</h4>
<form 
 method = "post" 
 class = "p2" 
 action-xhr = "/add_comment_amp.html" 
 target = "_top">
    <p>AMP - Form Example</p>
    <div>
       <input 
          type = "text" 
          name = "name" 
          placeholder = "Enter Name" required>
       <br/>
       <br/>
       <input 
          type = "email" 
          name = "email" 
          placeholder = "Enter Email" 
          required>
       <br/>
       <br/>
    </div>
    <input type = "submit" value = "Submit">
    <div submit-success>
       <template type = "amp-mustache">
          Form Submitted! Thanks {{name}}.
       </template>
    </div>
    <div submit-error>
       <template type = "amp-mustache">
          Error! {{name}}, please try again.
       </template>
    </div>
</form> -->


<div class="top-head">
	<div class="container cls">
		<div class="box-l">
			<a title="Địa chỉ" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 97.713 97.713" style="enable-background:new 0 0 97.713 97.713;" xml:space="preserve">
					<g>
						<path d="M48.855,0C29.021,0,12.883,16.138,12.883,35.974c0,5.174,1.059,10.114,3.146,14.684   c8.994,19.681,26.238,40.46,31.31,46.359c0.38,0.441,0.934,0.695,1.517,0.695s1.137-0.254,1.517-0.695   c5.07-5.898,22.314-26.676,31.311-46.359c2.088-4.57,3.146-9.51,3.146-14.684C84.828,16.138,68.69,0,48.855,0z M48.855,54.659   c-10.303,0-18.686-8.383-18.686-18.686c0-10.304,8.383-18.687,18.686-18.687s18.686,8.383,18.686,18.687   C67.542,46.276,59.159,54.659,48.855,54.659z"></path>
					</g>
				</svg>
				<?php echo $config['address'] ?>

			</a>
			<a title="Số điện thoại" href="tel:<?php echo $config['hotline'];?>">
				<?php echo $config['icon_phone'] ?> <span>Hotline:</span> <?php echo $config['hotline'];?>
			</a>
		</div>
		<div class="box-r">
			<?php  $tmpl -> load_direct_blocks('share',array('style'=>'fast_amp'))?>  
		</div>
	</div>
</div>


<div class='header_wrapper_wrap'>
	<div class='header_wrapper'>
		
		<div class='header container cls' id="header_inner">
			<div class="header-l">
				
				<div  class="sb-toggle-left navbar-left menu_show" id="click_menu_mobile_code">
					<button on="tap:mainmenu_sidebar.toggle" class="all-navicon-line" >
						<div class="navicon-line navicon-line-1"></div>
                        <div class="navicon-line navicon-line-2"></div>
                        <div class="navicon-line navicon-line-3"></div>
                    </button>
                </div>

                <?php if($Itemid == 1){?><h1><?php }?>
                <a href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>" class='logo' rel="home" >
                  <amp-img src="<?php echo URL_ROOT.$config['logo_mobile'];?>" alt="<?php echo $config['site_name']?>" width="230" height="33" ></amp-img>
              </a>
              <?php if($Itemid == 1){?></h1><?php }?>


              <div class="regions_search cls">
                <a href="<?php echo $link ?>" class="click_search_mobile">
                  <svg width="30px" height="30px" aria-hidden="true" data-prefix="far" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16"><path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z" class=""></path></svg>
              </a>
          </div>
      </div>

      <div class="header-r cls">
        <div class="shopcart">
           <?php echo $tmpl -> load_direct_blocks('shopcart',array('style'=>'simple')); ?>
       </div>
       <div class="support_top">
           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  x="0px" y="0px" viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
              <g>
                 <g>
                    <path d="M119.467,0C110.041,0,102.4,7.641,102.4,17.067V51.2h34.133V17.067C136.533,7.641,128.892,0,119.467,0z"/>
                </g>
            </g>
            <g>
             <g>
                <path d="M358.4,0c-9.426,0-17.067,7.641-17.067,17.067V51.2h34.133V17.067C375.467,7.641,367.826,0,358.4,0z"/>
            </g>
        </g>
        <g>
         <g>
            <path d="M426.667,51.2h-51.2v68.267c0,9.426-7.641,17.067-17.067,17.067s-17.067-7.641-17.067-17.067V51.2h-204.8v68.267    c0,9.426-7.641,17.067-17.067,17.067s-17.067-7.641-17.067-17.067V51.2H51.2C22.923,51.2,0,74.123,0,102.4v324.267    c0,28.277,22.923,51.2,51.2,51.2h375.467c28.277,0,51.2-22.923,51.2-51.2V102.4C477.867,74.123,454.944,51.2,426.667,51.2z     M443.733,426.667c0,9.426-7.641,17.067-17.067,17.067H51.2c-9.426,0-17.067-7.641-17.067-17.067V204.8h409.6V426.667z"/>
        </g>
    </g>
    <g>
     <g>
        <path d="M353.408,243.942c-6.664-6.669-17.472-6.672-24.141-0.009L204.8,368.401l-56.201-56.201    c-6.669-6.664-17.477-6.66-24.141,0.009c-6.664,6.669-6.66,17.477,0.009,24.141l68.267,68.267c6.665,6.663,17.468,6.663,24.132,0    L353.4,268.083C360.068,261.419,360.072,250.611,353.408,243.942z"/>
    </g>
</g>
</svg>
<a href="<?php echo URL_ROOT.$config['link_su_kien_hot'] ?>" title="Sự kiện HOT">Sự kiện HOT</a>
</div>


</div>
</div>
</div>	

</div>








<?php if(($Itemid !=1)){?>
	<div class='breadcrumbs'>
		<div class="container">
			<?php  echo $tmpl -> load_direct_blocks('breadcrumbs',array('style'=>'amp')); ?>
		</div>
	</div>
<?php }?>

<div class="main_content container">
	<?php  echo $main_content; ?>
</div>


<footer>
	<div class="container">
		<div class="top-ft cls">
			<div class="top-ft-l">
				<a href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>" class='logo-footer' rel="home" >
					<amp-img alt="<?php echo $config['site_name']?>" src="<?php echo URL_ROOT.$config['logo_bottom'];?>"  width="250" height="34"/>

                    </a>
                    <div class="footer_info">
                       <?php echo $config['footer_info']; ?>
                   </div>
                   <?php  $tmpl -> load_direct_blocks('share',array('style'=>'default _amp'))?>  
               </div>

               <div class="top-ft-c">
                <div class="title">
                   Liên hệ
               </div>
               <div class="content">
                   <div>
                      <?php echo $config['address'] ?>
                  </div>

                  <div>
                      Hotline: <a title="Hotline" href="tel:<?php echo $config['hotline'] ?>"><?php echo $config['hotline'] ?></a>
                  </div>
                  <div>
                      Zalo: <a title="zalo" href="tel:<?php echo $config['zalo'] ?>"><?php echo $config['zalo'] ?></a>
                  </div>
                  <div>
                      Website: <a title="Website" href="https://thegioithethao.vn">thegioithethao.vn</a>
                  </div>
                  <div>
                      Email: <a title="Email" href="#"><?php echo $config['email'] ?></a>
                  </div>
              </div>
          </div>

          <div class="top-ft-r">
            <?php echo $tmpl -> load_direct_blocks('mainmenu',array('style'=>'bottommenu_amp','group'=>'19')); ?> 
        </div>
    </div>

</div>

<div class="coppy-right">
  <?php echo $config['copy_right']; ?>
</div>

<div class="view_full">
    <a href="<?php echo $link; ?>" title="Xem phiên bản đầy đủ">Xem phiên bản đầy đủ</a>
</div>

</footer>

<?php echo $tmpl -> load_direct_blocks('mainmenu2',array('style'=>'amp','group'=>'2')); ?>