
<header>
    <div class="topline"></div>
    <div class="container">
        <div class="topinfo">
            <a href="/" class="logo">
                <div class="img">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="Xorazm viloyat sog'liqni saqlash boshqarmasi">
                </div>
                <div class="slogan">
                    <h1>Xorazm viloyati</h1>
                    <h1>sog'liqni saqlash</h1>
                    <h1>boshqarmasi</h1>
                </div>
            </a>
            <div class="info">
                <div class="contact">
                    <p>
                        <i class="fi fi-phone"></i>
                        <a href="">(62) 223-06-30</a>
                    </p>
                    <p>
                        <i class="fi fi-email"></i>
                        <a href="">info@xvssb.uz</a>
                    </p>
                </div>
                <div class="buttons">
                    <a href="#"><i class="fi fi-email"></i> Onlayn murojaat</a>
                    <ul class="tools">
                        <li><a href=""><i class="fi fi-low-vision"></i></a></li>
                        @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                        <li @if($locale == app()->getLocale()) class="active" @endif>
                            <a rel="alternate" hreflang="{{ $locale }}" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}"
                                ><img src="{{ asset('assets/images/'.$locale.'.jpg') }}" alt=""></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

</header>
