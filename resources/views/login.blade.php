
<!DOCTYPE html>
<html>

<head>
    <title>AccuHit</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link rel="stylesheet" href="css/colorbox.css" />
    <link rel="stylesheet" href="css/accunix.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--[if lt IE 9]>
        <script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="facebook_messenger">
        <h1 class="fb_register"><img src="img/messenger_logo.png">AccuHit Facebook Messenger Bot 註冊系統</h1>
        <p>★請登入 AccuHit Facebook 粉絲專頁綁定系統</p>
        <form method="POST" id="form1">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">帳號：</span>
                    </div>
                    <input type="text" name="email" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="請輸入登入帳號" required />
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">密碼：</span>
                    </div>
                    <input type="password" name="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="請輸入帳號密碼" required />
                </div>
            </div>

            <a href="#" class="btn-binding" onclick="login()">登入</a>
        </form>
    </div>
       
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.colorbox/1.3.34/jquery.colorbox-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="js/accunix.js"></script>
</body>

<script type="text/javascript">
<?php
if (!empty($_SESSION['alert'])) {
?>
        Swal.fire({
            type: "錯誤",
            title: "提示",
            text: "<?=$_SESSION['alert']?>"
        }) ;
<?php
    unset($_SESSION['alert']);
}
?>

$(document).ready(function() {

}) ;

function login() {
    let acc = $('[name="email"]').val();
    let pwd = $('[name="password"]').val();
    
    if ((acc == '') || (acc == undefined)) {
        Swal.fire({
            type: '錯誤',
            title: '提示',
            text: '請輸入帳號'
        }) ;
        $('[name="email"]').focus() ;
        
        return;
    }
    else if ((pwd == '') || (pwd == undefined)) {
        Swal.fire({
            type: '錯誤',
            title: '提示',
            text: '請輸入密碼'
        }) ;
        $('[name="password"]').focus() ;
        
        return;
    }
    else {
        $('#form1').submit();
    }
}
</script>

</html>