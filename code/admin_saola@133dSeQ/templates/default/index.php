<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS - Delectech</title>
    <link type='image/x-icon'   href='<?php echo URL_ROOT ?>favicon.ico' rel='icon' />
    <!-- Bootstrap Core CSS -->
    <link href="templates/default/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="templates/default/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="templates/default/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="templates/default/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="templates/default/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="templates/default/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <!--    <link href="templates/default/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">-->

    <!-- DataTables Responsive CSS -->
    <link href="templates/default/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" href="templates/default/css/chosen.css">
    <!-- DataTables Responsive CSS -->
    <link href="templates/default/css/styles.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" /> -->
    <!-- <script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script> -->



    <script type="text/javascript" src="templates/default/js/jquery-1.11.0.min.js"></script>
    
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>libraries/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>libraries/ckeditor/plugins/ckfinder/ckfinder.js"></script>
    <script>UPLOADCARE_PUBLIC_KEY = 'b0bd835a4330551312cd';</script>
</head>
<?php    $module= FSInput::get('module','','text');
$task= FSInput::get('task','orderhome','text');  
?>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include 'navbar.php'; ?>
        
        <div id="page-wrapper" class="" >
            <?php 
            global $toolbar;
            echo $toolbar->show_head_form();
            echo $main_content; 
            ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <div class="popup-notification">
        Thành công
    </div>
    <div class="go-top scrollToTop" style="display: none;">
        <i class="fa fa-arrow-circle-up"></i>
    </div>
    <!-- jQuery -->
    
    <script type="text/javascript" src="templates/default/js/helper.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="templates/default/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="templates/default/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="templates/default/bower_components/raphael/raphael-min.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="templates/default/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="templates/default/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="templates/default/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example1').DataTable({
                responsive: true,
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ trên mỗi trang",
                    "zeroRecords": "Không tìm thấy gì - xin lỗi",
                    "info": "Đang ở trang _PAGE_ của _PAGES_",
                    "infoEmpty": "Không có dữ liệu có sẵn",
                    "infoFiltered": "(lọc từ tổng số hồ sơ _MAX_)",
                    "search": "Tìm kiếm nhanh:",
                    paginate: {
                        first:    '«',
                        previous: '‹',
                        next:     '›',
                        last:     '»'
                    },
                },
                select: {
                    style: 'multi'
                },
                "lengthMenu": [ 10 ,20, 30, 40 , 50],
                "columnDefs": [
                { "orderable": false, "targets": 1 }
                ]
            });

        });
    </script>
    <!-- Custom Theme JavaScript -->
    <script src="templates/default/dist/js/sb-admin-2.js"></script>
    <script src="templates/default/dist/js/jquery.cookie.js"></script>

    <!-- Custom select chosen.jquery.js -->
    <script src="templates/default/js/chosen.jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
        var config = {
          '.chosen-select'           : {no_results_text: "Không tìm thấy "},
          '.chosen-select-deselect'  : {allow_single_deselect:true},
          '.chosen-select-no-single' : {disable_search_threshold:10},
          '.chosen-select-no-results': {no_results_text:"Không tìm thấy "},
          '.chosen-select-width'     : {width:"95%"}
      }
      for (var selector in config) {
          $(selector).chosen(config[selector]);
      }
  </script>
  <script>
    // popover demo
    $("[data-toggle=popover]").popover()
</script>
</body>

</html>
