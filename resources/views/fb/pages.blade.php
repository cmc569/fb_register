<!DOCTYPE html>
<html>

<head>
    <title>AccuHit</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link rel="stylesheet" href="../css/colorbox.css" />
    <link rel="stylesheet" href="../css/accunix.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--[if lt IE 9]>
        <script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="facebook_messenger">
        <div style="margin:10px 10px 10px 10px;">
            <h1 class="fb_register"><img src="../img/messenger_logo.png">AccuHit Facebook Messenger Bot 註冊系統</h1>
            <p>★指定要綁定的粉絲專頁</p>
            <form>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="company" name="company" value="Accuhit">
                    <label class="col-sm-12 col-form-label">我的粉絲專頁</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="sel1">
                            <option>請選擇欲綁定的粉絲專頁</option>

                            @foreach ($pages as $page) {
                            <option value="{{ $page['id'] }}">{{ $page['name'] }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 col-form-label">請選擇欲綁定的 APP</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="bot_app">
                            <option value="{{ config('facebook.app_id') }}" selected>AccuHit</option>
                        </select>
                    </div>
                </div>
                <a href="#" class="btn-binding" onclick="subscribe()">綁定</a>
            </form>
        </div>
    </div>
    
    <form id="form1" method="POST" action="{{ route('fb.subscribe') }}">
        {{ csrf_field() }}
        <input type="hidden" name="page" id="page">
        <input type="hidden" name="app" id="app">
    </form>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.colorbox/1.3.34/jquery.colorbox-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="../js/accunix.js"></script>
</body>

<script type="text/javascript">
$(document).ready(function() {

}) ;

function subscribe() {
    var unit = $('#company').val() ;
    var page = $('#sel1 :selected').val() ;
    var apps = $('#bot_app :selected').val() ;
    var re = /^\d+$/ ;
    
    if (re.test(page)) {
        $('#page').val(page) ;
        $('#app').val(apps) ;
        $('#form1').submit() ;
    }
    else {
        // alert('請指定欲綁定的粉絲專頁') ;
        Swal.fire({
            type: '錯誤',
            title: '提示',
            text: '請指定欲綁定的粉絲專頁'
        }) ;
        $('#sel1').focus() ;
    }  

}
</script>

</html>