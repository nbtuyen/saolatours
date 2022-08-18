<p id="msgReality"></p>
<input type="file" id="multiFilesReality" name="filesreality[]" multiple="multiple"/>
<label for="multiFilesReality" id="label_up_Reality">Chọn ảnh</label>
<div id="fileQueueReality"></div>
<div id="feedsReality"></div>
<script type="text/javascript">
    
        $('#label_up_Reality').on('click', function(){
          $('#msgReality').html('');   
      })
        $('#multiFilesReality').on('change', function () {
            // alert(11);
            var form_data = new FormData();
            var ins = document.getElementById('multiFilesReality').files.length;
            for (var x = 0; x < ins; x++) {
                form_data.append("filesreality[]", document.getElementById('multiFilesReality').files[x]);
            }
            $.ajax({

                        url: 'index.php?module=products&view=products&raw=1&task=uploadAjaxImagesReality&data=<?php echo $uploadConfig;?>")', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            $('#fileQueueReality').html(response); // display success response from the PHP script
                            $("#feedsReality").load("index.php?module=products&view=products&raw=1&task=getAjaxImagespnReality&data=<?php echo $uploadConfig;?>");
                            $('#msgReality').html('Đã upload xong !');
                            
                        },
                        error: function (response) {
                            $('#fileQueueReality').html(response); // display error response from the PHP script
                            $("#feedsReality").load("index.php?module=products&view=products&raw=1&task=getAjaxImagespnReality&data=<?php echo $uploadConfig;?>");
                        }
                    });
        });
  
    $("#feedsReality").load("index.php?module=products&view=products&raw=1&task=getAjaxImagespnReality&data=<?php echo $uploadConfig;?>");
</script>
<style>
    #msgReality {
        color: #3da6ea;
        font-size: 15px;
    }
    #multiFilesReality {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    #multiFilesReality + label {
        font-size: 1.25em;
        font-weight: 700;
        color: white;
        background-color: black;
        display: inline-block;
        cursor: pointer;
        padding: 10px 20px;
        box-sizing: bỏ;
        box-sizing: border-box;
        border-radius: 20px;
        transition: 0.5s;
    }

    #multiFilesReality:focus + label,
    #multiFilesReality + label:hover {
        background-color: red;
    }
</style>