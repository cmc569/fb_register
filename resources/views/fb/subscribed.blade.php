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
            <p>★粉絲專頁資訊</p>
            <div id="page_info">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">應用程式 ID</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{ $data['app']['id'] }}" readonly>
                </div>
                {{-- <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">應用程式 Secret</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="" readonly>
                </div> --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">粉絲頁 ID</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{ $data['page']['id'] }}" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">粉絲頁</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{ $data['page']['name'] }}" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Access Token</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{ $data['page']['access_token'] }}" readonly>
                </div>
                <div>
                    <ul>
                        @empty($data['subscribe']) @else <li><h6>{{ $data['subscribe'] }}</h6></li> @endempty
                        @empty($data['say_hello']) @else <li><h6>{{ $data['say_hello'] }}</h6></li> @endempty
                        @empty($data['get_start']) @else <li><h6>{{ $data['get_start'] }}</h6></li> @endempty
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.colorbox/1.3.34/jquery.colorbox-min.js"></script>
    <script src="../js/accunix.js"></script>
</body>
<script type="text/javascript">
$(document).ready(function() {
    // setTimeout("go_back()", 2000) ;
}) ;

</script>
</html>