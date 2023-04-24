<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/vjs/core/primeassets.css">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/vjs/core/primeicons.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/node-waves/waves.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/animate-css/animate.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/css/themes/theme-light-blue.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/date-paginator-css/datepaginator.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/MaterialThemes/plugins/bootstrap3.1-editable/css/bootstrap-editable3.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/CRMDashboard.css?20221209_58">


    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/notification/notification.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/SC_sidebar/SC_sidebarInfo.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/master_tribute_js/dist/tribute.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/SC_solodropdown/SC_solodropdown.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/SC_jobcommentalert/SC_jobcommentalert.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/SC_filter/SC_filter.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/SC_assetlist/SC_assetlist.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/SC_improveddashboard.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/SC_imagespreview/SC_imagespreview.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/SC_Plugin/SC_attachmentplugin/SC_attachment_carousel.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/asset/assetviewlist.css?20221209_58">
    <link rel="stylesheet" type="text/css" href="https://salesconnection.my/inc/jqueryCSVtoTable/css/csvtable.css?20221209_58">
    <!-- Sc Custom plugins -->
</head>
<style>

    #header {
        background: linear-gradient(270deg,#005c77,#30d2ff);
        box-shadow: 5px 10px 15px #c3c3c3;
        height: 80px;
        left: 0;
        padding: 15px 0;
        position: fixed;
        right: 0;
        top: 0;
        transition: all .5s;
        z-index: 997;
    }

    .container{
        width: 1050px;
    }

</style>
@yield('styles')

<body class="container" style="padding:30px; background-color:#d2d6d3!important;">
    <header id="header">
        <div class="container-fluid" style="padding-left:10px;padding-right:10px;">
            <div class="row ml-0 mr-0">
                <div class="col-xs-12 col-md-3">
                    <div id="logo" class="pull-left" style="">
                        <div class="row">
                                <a href="https://salesconnection.my"><img class="overrideBlog" src="https://d1ecswny2xx9fq.cloudfront.net/rrymalau/activity_comment/Clockifycode_(SC)_2022_Dec_11_vyt5zh8s_.png" alt="QR Based Attendance" title="QR Based Attendance" height="60" width="60" style="bottom: .8rem;position: relative;"></a>
                                <span style="font-size:40px; color:white;"><b><i>Quickieee</i></b></span>
                        </div>
                    </div>
                </div>
                @if(session('teacher_id'))
                    <div class="col-xs-12 ml-auto d-flex justify-content-end align-self-center" style="padding:0px;float: right;width:70px;">
                        <button class="btn btn-danger" onclick="logout();">Logout</button>
                    </div>
                @elseif(session('admin_id'))
                    <div class="col-xs-12 ml-auto d-flex justify-content-end align-self-center" style="padding:0px;float: right;width:70px;">
                        <button class="btn btn-danger" onclick="adminlogout();">Logout</button>
                    </div>
                @elseif($teacher == 1)
                    <div class="col-xs-12 ml-auto d-flex justify-content-end align-self-center" style="padding:0px;float: right;width:120px;">
                        <button class="btn btn-warning" onclick="adminlogin();">Admin Login</button>
                    </div>
                @elseif($teacher == 0 )
                    <div class="col-xs-12 ml-auto d-flex justify-content-end align-self-center" style="padding:0px;float: right;width:120px;">
                        <button class="btn btn-warning" onclick="teacherlogin();">Teacher Login</button>
                    </div>
                @endif

            </div>
        </div>
    </header>

    @yield('content')


</body>
</html>

<script type="text/javascript" src="https://salesconnection.my/inc/Jquery-3.3.1/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/plugins/tags/bootstrap-tagsinput.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/light-gallery/js/lightgallery-all.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/node-waves/waves.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/js/admin.js?20221209_58"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/js/demo.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/momentjs/moment.js" id="LibMomentJS" ></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/sweetalert/sweetalert-dev.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/js/pages/ui/tooltips-popovers.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/date-paginator-css/moment.js"> </script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/date-paginator-css/datepicker.js"> </script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/date-paginator-css/datepaginator.js"> </script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/bootstrap3.1-editable/js/bootstrap-editable.min.js"> </script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/plugins/bootstrap3.1-editable/js/bootstrap-editable4.js"> </script>
    <script type="text/javascript" src="https://rawgit.com/mikejacobson/jquery-bootstrap-scrolling-tabs/master/dist/jquery.scrolling-tabs.min.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/js/prettyprint.js"></script>
    <script type="text/javascript" src="https://salesconnection.my/MaterialThemes/js/map.js"></script>

    <!-- Sc Custom plugins -->
    <script type="text/javascript" src="https://salesconnection.my/inc/SC_Plugin/master_tribute_js/dist/tribute.js?20221209_58"></script>
    <script type="text/javascript" src="https://salesconnection.my/inc/jqueryCSVtoTable/js/jquery.csvToTable.js?20221209_58"></script>
    <script type="text/javascript" src="https://salesconnection.my/inc/papaparse/papaparse.min.js?20221209_58"></script>
    <script type="text/javascript" src="https://salesconnection.my/inc/jquery-mask/src/jquery.mask.js?20221209_58"></script>
    <!-- Sc Custom plugins -->

    <script type="text/javascript" src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>

    <script>
        function logout(){
            var this_url = '{{ env('APP_URL') }}'+'/logout';

            window.location.href=this_url;
        }

        function adminlogout(){
            var this_url = '{{ env('APP_URL') }}'+'/adminlogout';

            window.location.href=this_url;
        }

        function adminlogin(){
            var this_url = '{{ env('APP_URL') }}'+'/adminlogin';

            window.location.href=this_url;
        }

        function teacherlogin(){
            var this_url = '{{ env('APP_URL') }}'+'/login';

            window.location.href=this_url;
        }
    </script>
    @yield('scripts')
