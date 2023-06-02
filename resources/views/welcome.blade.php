<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/img/icon.svg">

    <title>PENSMART</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-light navbar-mart">
                <div class="container-fluid">
                    <div style="padding-left: 12px">
                        <img src="assets/img/logotype.svg" alt="gambar logo" height="20px">
                    </div>
                    <form class="d-flex" action="{{ route('login') }}">
                        <button class="btn btn-mart" type="submit">Masuk</button>
                    </form>
                </div>
            </nav>
        </header>

        <div class="home" id="home">
            <div class="row container home-wrapper justify-content-center align-items-center">
                <div class="col-8 col-md-8 col-sm-12">
                    <h1 class="heading">
                        <b>Tempat Terbaik<br>untuk Membeli<span><br>dan Menjual</span></b>
                    </h1>
                    <div class="subheading">
                        <p>Temukan Marchandise Hima mu<br> Disini !</p>
                    </div>
                    <form class="d-flex" action="{{ route('login') }}">
                        <button class="btn btn-mart btn-mulai" type="submit">Mulai Sekarang</button>
                    </form>
                </div>

                <div class="col-4 col-md-4 col-sm-12 landing-page">
                    <img src="assets/img/landingpage.svg" alt="gambar landing page" width="400px">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
