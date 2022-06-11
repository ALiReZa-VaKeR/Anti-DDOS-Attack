<?php
require "./core.php";


$ApiLocation = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$user_ip}"));
$location = $ApiLocation->geoplugin_countryCode;
if ($location != null) {
    $location = $location;
} else {
    $location = "";
}

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="./assets/css/style.css">
    <title>403</title>
</head>

<body>
    <h1 class="title_2134455">سیستم مقابله با تکذیب سرور</h1>
    <h3 class="title_2134455">
        شما در
        <span id="time">1</span>
        ثانیه دیگر به این صفحه منتقل میشوید
    </h3>
    <h4 id="proccess" class="p_111ss22">در حال بررسی اطلاعات ...</h4>

    <div class="info_221199">
        <p>آی پی : <span><?php echo $_SERVER['REMOTE_ADDR']; ?></span></p>
        <p>مرورگر : <span id="browser"></span></p>
        <p>سیستم عامل : <span id="system"><?php $uname  = php_uname();
                                            echo  substr($uname, 44, -6) ?></span></p>
        <p>کشور : <span><?php echo "(" . $location . ")"; ?> <img src="./assets/flags/<?php echo $location;  ?>.png" alt="" width="32px"></span></p>
    </div>

    <div class="wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="./assets/js/pace.js"></script>
    <script>
        setTimeout(() => {
            document.getElementById("proccess").innerHTML = "<?php echo $p1; ?>"
        }, 3000);
        setTimeout(() => {
            document.getElementById("proccess").innerHTML =
                "<?php echo $p2; ?>"
        }, 6000);

        var session_19940048SxQoLhe = sessionStorage.getItem("status");
        if (session_19940048SxQoLhe == "success/1") {
            
            setTimeout(() => {
                window.location.href = "<?php echo REDIRECT_HOME_PAGE; ?>"
            }, 10000);

        } else {
            window.history.back();
        }
        // timer
        var seconds = 10;
        var el = document.getElementById('time');

        function incrementSeconds() {
            seconds -= 1;
            el.innerText = seconds
        }

        var cancel = setInterval(incrementSeconds, 1000);
    </script>
</body>

</html>