<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-auto logo">
                    <a class="d-flex justify-content-start">
                        <x-icon.link/>
                        <span class="logo-title">ShrtLnk</span>
                    </a>
                </div>
                <div class="col user d-flex align-items-center justify-content-end">
                    @auth
                        <div class="auth">
                            <a href="{{ route('user.dashboard') }}">
                                <x-icon.user/>
                                <span>Personal account</span>
                            </a>
                        </div>
                    @endauth
                    @guest
                        <div class="guest">
                            <a href="{{ route('user.login') }}" class="mr-1">Sign in</a>
                            <a href="{{ route('user.registration') }}">Sign up</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        {{ $slot }}
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
                type: $(this).attr('method'),
                url: $(this).attr('action'),
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
