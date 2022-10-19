<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>SHRTLNK</title>
</head>
<body>
<div class="header">
    <h1>ShrtLnk</h1>
    <div class="line">
        <h2>Укорачиватель ссылок</h2>
        <div class="sign">
            <a href="{{ route('user.login') }}" class="in">Sign in</a>
            <span class="divider">/</span>
            <a href="{{ route('user.registration') }}" class="up">Sign up</a>
        </div>
    </div>
</div>
<div class="main">
    <div class="form">
        <form id="cut-form" action="/" method="POST">
            @csrf
            <input class="link" id="link" name="link" type="text">
            <input class="btn " id="send" type="submit" value="Shrt">
            <input class="btn hidden" id="copy" type="button" value="✂">
        </form>
    </div>
    <div class="error">

    </div>
    <div class="QR_code-wrapper" id="QR_code-wrapper">
        <img src="" alt="">
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("form").submit(function () {
            // Получение ID формы
            var formID = $(this).attr('id');
            // Добавление решётки к имени ID
            var formNm = $('#' + formID);
            $.ajax({
                type: "POST",
                url: '/getlink',
                data: formNm.serialize(),
                beforeSend: function () {
                },
                success: function (data) {
                    $('input#link').val(data);
                    $('input.btn').toggleClass('hidden');
                    QRCodeGenerate(data);
                },
                error: function (jqXHR, text, error) {
                    var errorBlock = $('.main .error');
                    errorBlock.text(error);
                    errorBlock.show();
                }
            });
            return false;
        });
        $('input#copy').click(function () {
            $('input#link').select();
            document.execCommand("copy");
        });
        function QRCodeGenerate (link){
            var src = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=';
            src += link;
            $('#QR_code-wrapper img').attr("src", src);
        }
    });

</script>
</body>
</html>
