<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChannelOn</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        <!--youtube 인기영상-->
        <div class="thumbs__wrapper">
            <div class="thumbs__header">
                <img class="thumbs__header--img" src="/images/logo/youtube_logo.png">
                <h3 class="thumbs__header--text">인기영상</h3>
            </div>
            @foreach($data['youtubeData'] as $key => $item)
            <div class="thumbs__item" style="{{ $key < 5 ? 'display: block;' : 'display: none;' }}">
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
            <div class="more_btn_line">
                <button class="more_btn" id="btn_youtube">더보기<strong>∨</strong></button>
            </div>
        </div>
        
        <!--END youtube 인기영상-->

        <!--치지직 인기영상-->
        <div class="thumbs__wrapper">
            <div class="thumbs__header">
                <img class="thumbs__header--img" src="/images/logo/chzzk_logo.png">
                <h3 class="thumbs__header--text">최신 다시보기</h3>
            </div>
            @foreach($data['chzzkData'] as $key => $item)
            <div class="thumbs__item" style="{{ $key < 5 ? 'display: block;' : 'display: none;' }}">
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
            <div class="more_btn_line">
                <button class="more_btn" id="btn_chzzk">더보기<strong>∨</strong></button>
            </div>
        </div>
        <!--END 치지직 인기영상-->
    </section>

</body>
<script>
$( document ).ready(function() {
    // YouTube 더보기 버튼 클릭 이벤트
    $("#btn_youtube").click(function(e){
        e.preventDefault();
        // 숨겨진 요소들을 보이게 함
        $(".thumbs__wrapper:first .thumbs__item:hidden").slice(0, 5).slideDown();
        // 모든 숨겨진 요소가 보이게 되면 더보기 버튼을 숨김
        if($(".thumbs__wrapper:first .thumbs__item:hidden").length == 0){
            $(this).hide();
        }
    });

    // 치지직 더보기 버튼 클릭 이벤트
    $("#btn_chzzk").click(function(e){
        e.preventDefault();
        // 숨겨진 요소들을 보이게 함
        $(".thumbs__wrapper:last .thumbs__item:hidden").slice(0, 5).slideDown();
        // 모든 숨겨진 요소가 보이게 되면 더보기 버튼을 숨김
        if($(".thumbs__wrapper:last .thumbs__item:hidden").length == 0){
            $(this).hide();
        }
    });
});
</script>

</html>