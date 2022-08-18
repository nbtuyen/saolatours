
<style>
  #gmap {
    height: 400px;
    margin: 20px 0px;
    width: 100% !important; 
  }

  .controls {
    margin-top: 16px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  }

  #pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 15px;
    text-overflow: ellipsis;
    width: 400px;
  }

  #pac-input:focus {
    border-color: #4d90fe;
  }

  .pac-container {
    font-family: Roboto;
  }

  #type-selector {
    color: #fff;
    background-color: #4d90fe;
    padding: 5px 11px 0px 11px;
  }

  #type-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }
</style>
<?php
$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
global $toolbar,$config;
$toolbar->setTitle($title);
$toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png'); 
$toolbar->addButton('Save',FSText :: _('Save'),'','save.png'); 
$toolbar->addButton('back',FSText :: _('Cancel'),'','cancel.png');   

$this -> dt_form_begin();

TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
TemplateHelper::dt_edit_text(FSText :: _('Address'),'address',@$data -> address);
TemplateHelper::dt_edit_selectbox(FSText::_('Khu vực'),'region_id',@$data -> region_id,0,$regions,$field_value = 'id', $field_label='name',$size = 1,0);
TemplateHelper::dt_edit_text(FSText :: _('Thông tin'),'info',@$data -> info);
TemplateHelper::dt_edit_text(FSText :: _('Điện thoại'),'phone',@$data -> phone);
TemplateHelper::dt_edit_text(FSText :: _('Tel'),'tel',@$data -> tel);
TemplateHelper::dt_edit_text(FSText :: _('Email'),'email',@$data -> email);
  if(@$data->country==0){
    TemplateHelper::dt_edit_text(FSText :: _('Link'),'link',@$data -> link);
  }
TemplateHelper::dt_checkbox(FSText::_('Đây là'),'country',@$data -> country,1,array(1=>'Liên hệ',0=>'Đất nước'));
TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',URL_ROOT.str_replace('/original/','/original/',@$data->image),40,50);

TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
	// TemplateHelper::dt_checkbox(FSText::_('Hiển thị trang liên hệ'),'show_contact',@$data -> show_contact,0);

TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
TemplateHelper::dt_edit_text(FSText :: _('Iframe'),'iframe',@$data -> iframe,'',100,9);
TemplateHelper::dt_edit_text(FSText :: _('Thông tin thêm'),'more_info',@$data -> more_info,'',650,450,1,'','','col-sm-2','col-sm-10');
?>
<?php if(@$data -> country==1){ ?>
<!--   <div class="form-group">
    <label class="col-sm-2 col-xs-12 control-label"><?php //echo FSText :: _('Bản đồ'); ?></label>
    <div class="col-sm-10 col-xs-12">
      <div id="map">
        <input id="pac-input" class="controls" type="text" placeholder="tìm kiếm vị trí của bạn ..." />
        <div id="gmap" style="width: 100%; height: 400px;"></div> 
        <input type="hidden" name="latitude" id="latitude" value="<?php //if(isset($latitude)) echo $latitude ?>"  />
        <input type="hidden" name="longitude" id="longitude" value="<?php //if(isset($longitude)) echo $longitude ?>"  />
      </div>
    </div>
  </div> -->
<?php }elseif(@$data -> country==0){ ?>
  <div class="form-group">
    <label class="col-sm-2 col-xs-12 control-label"><?php echo FSText :: _('World map'); ?></label>
    <div class="col-sm-10 col-xs-12">
     
      <input type="text" class="form-control hidden" name="x" id="x" value="<?php echo @$data -> x; ?>" size="60">
      <input type="text" class="form-control hidden" name="y" id="y" value="<?php echo @$data -> y; ?>" size="60">
     <div class="map">
      <div class="map_inner">
        <img class="img_map" id="img_map" src="<?php echo URL_ROOT.@$map->value; ?>" alt="<?php echo 'World map'; ?>">
        <?php if(@$data->x && @$data->y){ ?>

          <?php 
          $x = ($data->x/760*100)*7.6; 
                $y = ($data->y/375*100)*3.75;
                $x_ = ($data->x/760*100);
                $y_ = ($data->y/375*100);
           ?>

          <div class="location" style="background-image: url('<?php echo URL_ROOT.@$data->image; ?>'); left: <?php echo $x_; ?>%; top: <?php echo $y_; ?>%; "></div>
        <?php }else{ ?>
          <?php 
          // $x = ($data->x/760*100)*7.6; 
                // $y = ($data->y/375*100)*3.75;
                $x_ = (250/760*100);
                $y_ = (120/375*100);
           ?>
           <div class="location" style="background-image: url('<?php echo URL_ROOT.'images/location.png'; ?>'); left: <?php echo $x_; ?>%; top: <?php echo $y_; ?>%; "></div>
        <?php } ?>
      </div>
      
      </div>
    </div>
  </div>
<?php } ?>
<style>
.map{
  text-align: center;
}
.map_inner{
  display: inline-grid;
  position: relative;
}
.location{
  position: absolute;
  width: 40px;
  height: 50px;
  transform: translate(-50%,-100%);
  background-repeat: no-repeat;
  background-position: center;
}
</style>
<!-- <script src="libraries/jquery-3.4.1.js"></script> -->
<script type="text/javascript">

  //   $(".img_map").mousemove(function ( e ) {
  //       var pos   = $(this).offset();
  //       var elPos = { X:pos.left , Y:pos.top };
  //       var mPos  = { X:e.clientX-elPos.X, Y:e.clientY-elPos.Y };
  //       $("#log").text("Mouse position x:"+ mPos.X +" y:"+ mPos.Y); 
  // });


  function findObjectCoords(mouseEvent)
{
  var obj = document.getElementById("img_map");
  var obj_left = 0;
  var obj_top = 0;
  var xpos;
  var ypos;
  while (obj.offsetParent)
  {
    obj_left += obj.offsetLeft;
    obj_top += obj.offsetTop;
    obj = obj.offsetParent;
  }
  if (mouseEvent)
  {
    //FireFox
    xpos = mouseEvent.pageX;
    ypos = mouseEvent.pageY;
  }
  else
  {
    //IE
    xpos = window.event.x + document.body.scrollLeft - 2;
    ypos = window.event.y + document.body.scrollTop - 2;
  }
  xpos -= obj_left;
  ypos -= obj_top;

  // $('#x').val(xpos);
  // $('#y').val(ypos);
  $('#x').attr('value',xpos);
  $('#y').attr('value',ypos);
}
document.getElementById("img_map").onclick = findObjectCoords;

click_f();
function click_f(){
  




  $('.img_map').click(function(){
    var x_id = $('#x').val();

  var x = x_id/760*100;

  var y_id = $('#y').attr('value');

  var y = y_id/375*100;
    $(this).parent().find('.location').css({left:x+'%'}).css({top:y+'%'});
   
  });
  
}


</script>




<?php 
//	TemplateHelper::dt_edit_text(FSText :: _('Tags'),'tags',@$data -> tags,'',100,4);
$this -> dt_form_end(@$data,1);

?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtzG8NO_caSWEcDgso66YMGaXRHQuQByw&libraries=geometry,places&callback=initialize&sensor=false" async defer></script>
<script type="text/javascript">
  var oldMarker;
  function initialize() {
    <?php 
    $latitude = @$data -> latitude? $data -> latitude:'21.028224';
    $longitude = @$data -> longitude? $data -> longitude:'105.835419';
    ?>
    var latlng = new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>);
    var markers = [];
    var image = '/images/arrow-up1.png';
    var myOptions = {
      zoom: 13,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,  
    };
    var map = new google.maps.Map(document.getElementById("gmap"),myOptions);
    google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
    });
    // Create the search box and link it to the UI element.
    var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var searchBox = new google.maps.places.SearchBox(
      /** @type {HTMLInputElement} */(input));

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(120, 120),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(30, 30)
        
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
    map.setZoom(12);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
  function placeMarker(location) {
    marker = new google.maps.Marker({
      position: location,
      map: map,
      animation: google.maps.Animation.DROP,
      icon: image,
    });
    if (oldMarker != undefined){
      oldMarker.setMap(null);
    }
    oldMarker = marker;
    map.setCenter(location);
		//var infowindow = new google.maps.InfoWindow({
//			content: $('#title').val(),
//			maxWidth: 3500
//		});
		//infowindow.open(map,marker);
		document.getElementById("latitude").value = location.lat();

		document.getElementById("longitude").value = location.lng();
  }
  placeMarker(latlng);
}
google.maps.event.addDomListener(window, 'load', initialize());
</script>

