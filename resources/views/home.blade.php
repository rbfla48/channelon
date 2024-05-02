<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChannelOn</title>
    @vite(['resources/css/home.css']);
</head>

<body>
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__start">
                <button class="header__hamburger">&#9776;</button>
                <span class="header__title">ChannelOn</span>
            </h1>

            <div class="header__center">
                <form class="header__form" onsubmit="return false;">
                    <input class="header__input--text" placeholder="스트리머,제목 검색">
                    {{-- <button class="header__input--button">검색</button> --}}
                </form>

            </div>
            <div class="header__end">
                <button class="header__search">&#128269;</button>
                <div class="header__profile"></div>
            </div>
        </div>
    </header>

    <nav class="nav">
        <ul class="nav__wrapper">
            <li class="nav__item">
                <button class="nav__menu"><span>HOME</span></button>
            </li>
            <li class="nav__item">
                <button class="nav__menu"><span>라이브</span></button>
            </li>
            <li class="nav__item">
                <button class="nav__menu"><span>지난영상</span></button>
            </li>
        </ul>
    </nav>

    <section class="thumbs">
        <div class="thumbs__wrapper">
            @foreach($data as $item)
            <div class="thumbs__item">
                <div class="thumbs__area">
                    <img class="thumbs__thumbnail" src="{{ $item->thumbnail }}">
                </div>
                <div class="thumbs__info">
                    {{-- <div class="thumbs__profile"></div> --}}
                    <div class="thumbs__text">
                        <h3 class="thumbs__text--title">{{ $item->title }}</h3>
                        <p class="thumbs__text--owner">{{ $item->channel }}</p>
                        {{-- <p class="thumbs__text--anal">조회수 100회 &#183; 1시간 전</p> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

</body>

</html>