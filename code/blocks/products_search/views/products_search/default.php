<?php 
global $tmpl, $config;
// $tmpl -> addScript("jquery.autocomplete","blocks/search/assets/js");
$tmpl -> addStylesheet('products_search','blocks/products_search/assets/css');
$tmpl -> addScript("products_search","blocks/products_search/assets/js");
?>


    <form class="cls" action="<?php echo $link; ?>" name="search_form" id="search_form" method="get" onsubmit="javascript: submit_form_search_cat(); return false;" >
        <div class="search_field_box_all cls">
            <div class="search_field_box1 cls">
                <div class="search_field">
                    <select class="sl-cat" id='sl_city' name="sl_city">
                        <option value="">Chọn Tỉnh/Thành Phố</option>
                        <?php foreach($cities as $item){ ?>
                            <?php
                                $city_alias = FSInput::get('tinhthanh'); 
                            ?>
                            <option value="<?php echo $item->alias ?>" <?php echo $item->alias == $city_alias ?'selected="selected"':''?>  rid="<?php echo $item->id ?>"> <?php echo $item->name; ?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="search_field">
                    <select class="sl-cat" id='sl_district' name="sl_district">
                        <option value="">Chọn Quận/Huyện</option>
                        <?php if(!empty($districts)){ ?>
                        <?php foreach ($districts as $item) { ?>
                            <?php
                                $district_alias = FSInput::get('quanhuyen'); 
                            ?>
                            <option value="<?php echo $item->alias ?>" <?php echo $item->alias == $district_alias ?'selected="selected"':''?>  rid="<?php echo $item->id ?>"> <?php echo $item->name; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="search_field_box2">
                <div class="search_field">
                    <select class="sl-cat" id='sl_people' name="sl_people">
                        <option value="">Loại sân</option>
                        <?php if(!empty($peoples)){ ?>
                            <?php foreach($peoples as $item){ ?>
                                <?php
                                    $people_alias = FSInput::get('loaisan'); 
                                ?>
                                <option value="<?php echo $item->alias ?>" <?php echo $item->alias == $people_alias ?'selected="selected"':''?>  rid="<?php echo $item->id ?>"> <?php echo $item->name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>


                <div class="search_field">
                    <select class="sl-cat" id='sl_date' name="sl_date">
                        <option value="">Chọn ngày</option>
                    </select>
                </div>

                <div class="search_field">
                    <select class="sl-cat" id='sl_time' name="sl_time">
                        <option value="">Chọn thời gian</option>
                    </select>
                </div>
            </div>

            <div class="search_field_box3">
                <button type="submit" class="button-search-soccer" id='product_searchbt' class = 'product_searchbt'>Tìm kiếm</button>
                <div class="filter_orther">
                    <div class="filter_orther_click">
                        Lọc thêm <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" height="40px" viewBox="0 0 512 512" width="40px"><g><path d="m420.404 0h-328.808c-50.506 0-91.596 41.09-91.596 91.596v328.809c0 50.505 41.09 91.595 91.596 91.595h328.809c50.505 0 91.595-41.09 91.595-91.596v-328.808c0-50.506-41.09-91.596-91.596-91.596zm61.596 420.404c0 33.964-27.632 61.596-61.596 61.596h-328.808c-33.964 0-61.596-27.632-61.596-61.596v-328.808c0-33.964 27.632-61.596 61.596-61.596h328.809c33.963 0 61.595 27.632 61.595 61.596z"/><path d="m432.733 112.467h-228.461c-6.281-18.655-23.926-32.133-44.672-32.133s-38.391 13.478-44.672 32.133h-35.661c-8.284 0-15 6.716-15 15s6.716 15 15 15h35.662c6.281 18.655 23.926 32.133 44.672 32.133s38.391-13.478 44.672-32.133h228.461c8.284 0 15-6.716 15-15s-6.716-15-15.001-15zm-273.133 32.133c-9.447 0-17.133-7.686-17.133-17.133s7.686-17.133 17.133-17.133 17.133 7.686 17.133 17.133-7.686 17.133-17.133 17.133z"/><path d="m432.733 241h-35.662c-6.281-18.655-23.927-32.133-44.672-32.133s-38.39 13.478-44.671 32.133h-228.461c-8.284 0-15 6.716-15 15s6.716 15 15 15h228.461c6.281 18.655 23.927 32.133 44.672 32.133s38.391-13.478 44.672-32.133h35.662c8.284 0 15-6.716 15-15s-6.716-15-15.001-15zm-80.333 32.133c-9.447 0-17.133-7.686-17.133-17.133s7.686-17.133 17.133-17.133 17.133 7.686 17.133 17.133-7.686 17.133-17.133 17.133z"/><path d="m432.733 369.533h-164.194c-6.281-18.655-23.926-32.133-44.672-32.133s-38.391 13.478-44.672 32.133h-99.928c-8.284 0-15 6.716-15 15s6.716 15 15 15h99.928c6.281 18.655 23.926 32.133 44.672 32.133s38.391-13.478 44.672-32.133h164.195c8.284 0 15-6.716 15-15s-6.716-15-15.001-15zm-208.866 32.134c-9.447 0-17.133-7.686-17.133-17.133s7.686-17.133 17.133-17.133 17.133 7.685 17.133 17.132-7.686 17.134-17.133 17.134z"/></g></svg>
                    </div>
                    <div class="filter_orther_body">
                        <?php if(!empty($utilities)){ ?>
                            <div class="filter_orther_tt">Tiện ích</div>
                            <?php foreach ($utilities as $item) { ?>
                            <?php $tienich = FSInput::get('tienich'); ?>
                                <div class="item">
                                    <input <?php echo strpos($tienich, $item->alias) !== false ? "checked" : "" ?> class="ip-checkbox" type="checkbox" value="<?php echo $item->alias; ?>"  name="other_utilities[]"  />
                                    <span><?php echo $item->name ?></span> 
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
         </div>

    
        <input type='hidden' name="module" id='link_cat' value="<?php echo $link ?>" />
        <input type='hidden' name="view" value="cat"/>
        <input type='hidden' name="Itemid" value="10"/>
    </form>

