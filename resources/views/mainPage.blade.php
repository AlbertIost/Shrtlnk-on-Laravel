<x-layout title="ShrtLnk">
    <div class="container">
        <div class="row">
            <div class="col-12 title">Link shortening service</div>
        </div>
        <form id="cut-form" action="{{ route('getlink') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-md-9 pt-3">
                    <input placeholder="Enter long url" class="@error('link') is-invalid @enderror link col-12 form-control form-control-lg" id="link" name="link" type="text">
                    @error('link')
                        <span class="invalid-feedback animated fadeInDown">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 col-md-3 pt-3">
                    <input class="btn btn-lg col-12" id="send" type="submit" value="Shrt">
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-6 pt-3">
                    <input type="text" class="@error('alias') is-invalid @enderror form-control" placeholder="Alias" name="alias">
                    @error('alias')
                    <span class="invalid-feedback animated fadeInDown">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-6 col-md-6 pt-3">
                    <input type="text" class="@error('password') is-invalid @enderror form-control" placeholder="Password" name="password">
                    @error('password')
                    <span class="invalid-feedback animated fadeInDown">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </form>
        @isset($short_url)
            <div class="result mt-3 p-4">
                <div class="row d-flex align-items-center">
                    <div class="col-md-10 col-12">
                        <div class="input-group shorten">
                            <input readonly type="text" id="short-url-for-copy" class="form-control" value="{{ $short_url }}">
                            <button id="copy" class="btn" data-target="short-url-for-copy">
                                <span class="d-md-inline d-none">Copy</span>
                                <span class="d-md-none d-inline">✂</span>
                            </button>
                        </div>
                        <div class="share d-flex align-items-center justify-content-between">
                            <a class="tg" href="https://t.me/share/url?url={{ $short_url }}"><x-icon.social.telegram/></a>
                            <a class="whatsapp" href="https://api.whatsapp.com/send?text={{ $short_url }}"><x-icon.social.whatsapp/></a>
                            <a class="vk" href="https://vk.com/share.php?url={{ $short_url }}"><x-icon.social.vk/></a>
                            <a class="facebook" href="https://www.facebook.com/sharer.php?src=sp&u={{ $short_url }}"><x-icon.social.facebook/></a>
                            <a class="twitter" href="https://twitter.com/intent/tweet?text={{ $short_url }}"><x-icon.social.twitter/></a>
                            <a class="skype" href="https://web.skype.com/share?url={{ $short_url }}"><x-icon.social.skype/></a>
                            <a class="viber" href="viber://forward/?text={{ $short_url }}"><x-icon.social.viber/></a>
                            <a class="odnoklassniki" href="https://connect.ok.ru/offer?url={{ $short_url }}"><x-icon.social.odnoklassniki/></a>
                            <a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{ $short_url }}"><x-icon.social.linkedin/></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 pt-3 pt-md-0 QR_code-wrapper d-flex justify-content-center">
                        <img id="QR_code" src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ $short_url }}" alt="">
                    </div>
                </div>
            </div>
        @endisset
    </div>
</x-layout>
