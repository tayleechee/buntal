<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Kampung Buntal</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('welcome_assets/images/favicon.png') }}" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('welcome_assets/css/bootstrap.min.css') }}">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="{{ asset('welcome_assets/css/LineIcons.css') }}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('welcome_assets/css/magnific-popup.css') }}">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ asset('welcome_assets/css/slick.css') }}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{ asset('welcome_assets/css/animate.css') }}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('welcome_assets/css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('welcome_assets/css/style.css') }}">


</head>

<body>
    
    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== NAVBAR PART START ======-->

    <section class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#">
                               <h3 style="color:white;">Kampung Buntal</h3>
                            </a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarEight" aria-controls="navbarEight" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">UTAMA</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#sejarah">SEJARAH</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#penduduk">PENDUDUK</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#pendidikan">PENDIDIKAN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#pelancongan">PELANCONGAN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#homestay">HOMESTAY</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#AJK">AJK</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#contact">PETA</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="navbar-btn d-none mt-15 d-lg-inline-block">
                                <a class="menu-bar" href="#side-menu-right"><i class="lni-menu"></i></a>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
        
        <div id="home" class="slider-area">
            <div class="bd-example">
                <div id="carouselOne" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselOne" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselOne" data-slide-to="1"></li>
                        <li data-target="#carouselOne" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item bg_cover active" style="background-image: url({{ asset('welcome_assets/images/slider-1.jpg') }})">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            <h2 class="carousel-title">NIKMATI MAKANAN LAUT SEGAR</h2>
                                        </div>
                                    </div> <!-- row -->
                                </div> <!-- container -->
                            </div> <!-- carousel caption -->
                        </div> <!-- carousel-item -->

                        <div class="carousel-item bg_cover" style="background-image: url({{ asset('welcome_assets/images/slider-2.jpg') }})">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            <h2 class="carousel-title">PEMANDANGAN PANTAI DAN LAUT YANG CANTIK</h2>
                                            </div>
                                    </div> <!-- row -->
                                </div> <!-- container -->
                            </div> <!-- carousel caption -->
                        </div> <!-- carousel-item -->

                        <div class="carousel-item bg_cover" style="background-image: url({{ asset('welcome_assets/images/slider-3.jpg') }})">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            <h2 class="carousel-title">HOMESTAY & REKREASI</h2>
                                    </div> <!-- row -->
                                </div> <!-- container -->
                            </div> <!-- carousel caption -->
                        </div> <!-- carousel-item -->
                    </div> <!-- carousel-inner -->

                    <a class="carousel-control-prev" href="#carouselOne" role="button" data-slide="prev">
                        <i class="lni-arrow-left-circle"></i>
                    </a>

                    <a class="carousel-control-next" href="#carouselOne" role="button" data-slide="next">
                        <i class="lni-arrow-right-circle"></i>
                    </a>
                </div> <!-- carousel -->
            </div> <!-- bd-example -->
        </div>

    </section>

    <!--====== NAVBAR PART ENDS ======-->

    <!--====== SAIDEBAR PART START ======-->

    <div class="sidebar-right">
        <div class="sidebar-close">
            <a class="close" href="#close"><i class="lni-close"></i></a>
        </div>
        <div class="sidebar-content">
            <div class="sidebar-logo text-center">
                <a href="#"><img src="{{ asset('welcome_assets/images/logo-alt.png') }}" alt="Logo"></a>
            </div> <!-- logo -->
            <div class="sidebar-menu">
                <ul>
                    <li><a href="#">LOGIN</a></li>
                </ul>
            </div> <!-- menu -->
            <div class="sidebar-social d-flex align-items-center justify-content-center">
                <span>Service Learning</span>
                <ul>
                    <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                    <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                </ul>
            </div> <!-- sidebar social -->
        </div> <!-- content -->
    </div>
    <div class="overlay-right"></div>

    <!--====== SAIDEBAR PART ENDS ======-->
    
    <!--====== ABOUT PART START ======-->
    <section style="background: #707780;">
        <h1 style="padding-top: 20px;padding-bottom: 20px;color:white;text-align: center;">SELAMAT DATANG</h1>
    </section>
    <section id="sejarah" class="about-area" style="background-image: url({{ asset('welcome_assets/images/kampung.jpg') }}); background-repeat:no-repeat;background-size:100% 100%; background-attachment:fixed;">
        <div class="container" style="background-color: rgb(0,0,0); background-color: rgba(0,0,0, 0.6);">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <!-- <div class="about-image text-center wow fadeInUp" data-wow-duration="1.5s" data-wow-offset="100">
                        <img src="assets/images/kampung.jpg" alt="services" style="border-radius: 15%;">
                    </div> -->
                    <div class="section-title text-center mt-30 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s" style="color: white;">Sejarah</h4>
                        <p class="text wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s" style="color: white;">Kampung Buntal terletak di Kuching, Sarawak. Menurut orang zaman dulu, berasalnya nama Kampung Buntal merujuk kepada Sungai Buntal yang pada masa itu terkenal dengan Ikan Buntal Kuning yang begitu banyak kira-kira 300 tahun dulu. 

</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/puffer.svg') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text" style="color: white;">Di mana, para nelayan menjala ikan di rempang(empayan), hasil tangkapan pada waktu itu sentiasa akan mendapat ikan buntal. Pada zaman dahulu, orang luar seperti British atau orang Tenggara akan menjadikan Kampung Buntal sebagai tempat persinggahan semasa mereka belayar. </p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/dolphin.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text" style="color: white;">Nek Tanggang merupakan orang pertama yang mendiami Kampung Buntal. Beliau terpesona dengan kedudukan kampung tersebut lalu membawa keluarganya menetap di situ selain menjadi tempat persinggahan ketika menangkap ikan. Selain itu, bermulanya kehidupan di Kampung Buntal kerana kedudukan kampung tersebut dikatakan strategik malah dijadikan kawasan berlindung khususnya pada musim tengkujuh.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/crab.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text" style="color: white;padding-bottom: 20px;">Asalnya Kampung Buntal adalah terletak di susur laut(hujung kampung). Kini, penduduk kampung tinggal di kampung pemindahan disebabkan berlakunya hakisan pantai yang memaksa penduduk untuk bertempat di kawasan yang jauh daripada pantai.
Kampung Buntal memang sejak dari dulu terkenal dengan Destinasi Makanan Laut.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/nemo.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text" style="color: white;"> Selain itu, kampung tersebut turut menjadikan tumpuan pelancong tidak kira dalam atau luar negara selain menjadi pusat pengeluaran belacan, ikan kering, dan kek lapis Sarawak.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section id="penduduk" class="about-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="about-image text-center wow fadeInUp" data-wow-duration="0.5s" data-wow-offset="100">
                        <img src="{{ asset('welcome_assets/images/Fishing.jpg') }}" alt="services" style="border-radius: 15%;">
                    </div>
                    <div class="section-title text-center mt-30 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="0.5.5s" data-wow-delay="0.5s">Penduduk</h4>
                        <p class="text wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">Keluasan Kampung Buntal adalah 62 Hektar. 400 buah rumah telah didirikan disana. Hampir 500 orang penduduk yang menghuni di Kampung Buntal di mana 99% penghuni adalah bangsa Melayu dan 1% adalah bangsa Cina. 

</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/puffer.svg') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text"> Rumah penduduk di situ dibina sepanjang jalan kampung dan masih mengekalkan seni bina tradisional dan rata-rata penduduk di situ hidup dalam keadaan serdehana.
Jarak antara Kampung Buntal dan pusat bandar kira-kira 32Km.  </p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/dolphin.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text">Sebelum 80-an, di mana belum adanya jalan raya di Kampung Buntal, penduduk kampung hendaklah menggunakan perahu untuk ke pusat bandar dan mereka akan bermalam di sana lalu pulang pada keesokannya. Pada hujung tahun 90-an, jambatan dibina di kampung tersebut. Oleh itu, penduduk kampung yang hendak ke pusat bandar tidak perlu bermalam lagi di sana, kerana masa yang diambil untuk ke sana hanyalah kira-kira 3 hingga 4 jam.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/crab.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text">Pada 23 hingga 24 November, penduduk akan menyambut Pesta Buntal or Buntal Day. Pesta ini hanyalah disambut oleh penduduknya sendiri. Aktiviti yang dijalankan seperti pertandingan menjaring dan menyagang ikan buntal, sukaneka,  perahu lumba, pertandingan bertandak dan bertandak, gerai jualan dan lain-lain lagi.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/nemo.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text"> Selain itu, kampung tersebut turut menjadikan tumpuan pelancong tidak kira dalam atau luar negara selain menjadi pusat pengeluaran belacan, ikan kering, dan kek lapis Sarawak.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section id="pendidikan" class="about-area" style="background-image: url({{ asset('welcome_assets/images/sekolah.jpg') }}); background-repeat:no-repeat;background-size:cover; background-attachment:fixed;">
        <div class="container" style="background-color: rgb(0,0,0); background-color: rgba(0,0,0, 0.6);">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="about-image text-center wow fadeInUp" data-wow-duration="0.5s" data-wow-offset="100">
                    </div>
                    <div class="section-title text-center mt-30 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s" style="color: white;">Pendidikan</h4>
                        <p class="text wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s" style="color: white;">Pada tahun 1936, sebuah sekolah kebangsaan telah ditubuhkan dan diasaskan oleh seorang guru bernama Haji Nahrawi Man. 

</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/puffer.svg') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text" style="color: white;"> Sekolah tersebut dinamakan sebagai Sekolah Kebangsaan Kampung Buntal atau dulu dikenali sebagai Sekolah Rakyat Kampung Buntal. </p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/dolphin.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text" style="color: white;"> Sekolah ini merupakan titik permulaan pendidikan di Kampung Buntal dan pada awal penubuhan sekolah ini hanya mempunyai seramai 60 orang murid ketika itu.  </p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/crab.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text" style="color: white;">Pembinaan Sekolah Kebangsaan kampung Buntal sepenuhnya diusahakan oleh penduduk Kampung Buntal sendiri dengan bergotong-royong mengerah keringat demi masa depan anak-anak mereka. </p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/nemo.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text" style="color: white;padding-bottom: 10px">Kini, dengan adanya pengorbanan yang lalu, tahap pendidikan di Kampung Buntal ditingkatkan dengan penubuhan sekolah-sekolah lain seperti Sekolah Jenis Kebangsaan Cina (C) Chiang Hua dan terdapat juga Tabika Kemas, khas untuk murid-murid pra-sekolah agar pendidikan terus mengalir tanpa mengira umur dan bangsa.
                            </p>
                        </div>
                    </div> <!-- single about -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section id="pelancongan" class="about-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                   <div class="about-image text-center wow fadeInUp" data-wow-duration="1.5s" data-wow-offset="100">
                        <img src="{{ asset('welcome_assets/images/pelancongan.jpg') }}" alt="services" style="border-radius: 15%;">
                    </div>
                    <div class="section-title text-center mt-30 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">Pelancongan</h4>
                        <p class="text wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">Selain daripada tarikan makanan laut yang segar, keistimewaan Kampung Buntal itu sendiri menarik ramai minat pelancong tidak kira dalam atau luar negara.
Terdapat pelbagai keistimewaan di Kampung Buntal seperti:  

</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/puffer.svg') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text">Buntal Esplanade merupakan laluan penjalan kaki yang indah menghadap Laut China Selatan. Para pelancong juga boleh menikmati suasana pantai yang cantik. Jika pelancong ingin menangkap gambar sebagai kenang-kenangan, Buntal Esplanade sesuai untuk dijadikan latar belakang kerana pemandangan matahari terbit dan matahari terbenam boleh dilihat di situ. </p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-content media-body">
                            <img src="{{ asset('welcome_assets/images/esplenade.jpg') }}" alt="Icon">
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-content media-body">
                            <img src="{{ asset('welcome_assets/images/freshseafood.jpg') }}" alt="Icon">
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/nemo.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text"> Ramai pelancong tidak sedar akan keunikan yang terdapat di Kampung Buntal. Hal ini kerana, Kampung Buntal terdapat tarikan seperti kelip-kelip di tepi sungai pada waktu malam. Selain itu terdapat juga ikan lumba- lumba boleh ditemui bermain di sekitar muara sungai. Spesies ikan lumba-lumba tersebut adalah Ikan Lumba Irrawaddy atau dikenali juga sebagai Ikan Besut oleh penduduk kampung. Pelancong boleh mendapat servis tersebut daripada pemandu pelancong atau menghubungi ketua kampung di sana.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-icon">
                            <img src="{{ asset('welcome_assets/images/nemo.png') }}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text"> Pelancong boleh mendapat servis seperti ingin melihat kelip-kelip, Monyet Belanda, buaya, dan ikan lumba-lumba daripada pemandu pelancong atau menghubungi ketua kampung di sana. Selain daripada itu, aktiviti mengail, mencalak atau menangkap ikan boleh dilakukan di situ. Kampung Buntal juga menyediakan kemudahan seperti penyewaan bot bagi memudahkan para pengail melakukan aktiviti di situ.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-content media-body">
                            <img src="{{ asset('welcome_assets/images/mountain.jpg') }}" alt="Icon">
                        </div>
                    </div> <!-- single about -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->

     <!--====== ABOUT PART START ======-->

    <!-- <section id="about" class="about-area" style="background-image: url(assets/images/homestay.jpg); background-repeat:no-repeat;background-size:cover;>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title text-center mt-30 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.6s">Homestay</h4>
                        <p class="text wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">Pelancong yang ingin bermalam di Kampung Buntal boleh mendapatkan tempat beristirehat seperti menyewa Homestay. Pada mulanya homestay merupakan sebuah rumah yang dikongsi(3-5 buah rumah) bersama dengan keluarga penyewa homestay tersebut. Tetapi, pelancong kini tidak selesa dengan keadaan tersebut. Penduduk kampung menitik berat hal ini, kini 5 buah homestay telah diadakan di kampung tersebut. Pelancong yang ingin menyewa homestay tersebut boleh menghubungi Encik Wahab untuk bertanyakan lebih lanjut.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.2s">
                        <div class="about-icon">
                            <img src="assets/images/puffer.svg" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text">Pada mulanya homestay merupakan sebuah rumah yang dikongsi(3-5 buah rumah) bersama dengan keluarga penyewa homestay tersebut. Tetapi, pelancong kini tidak selesa dengan keadaan tersebut. Penduduk kampung menitik berat hal ini, kini 5 buah homestay telah diadakan di kampung tersebut. Pelancong yang ingin menyewa homestay tersebut boleh menghubungi Encik Wahab untuk bertanyakan lebih lanjut.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!--====== ABOUT PART ENDS ======-->

     <!--====== portfolio PART START ======-->

    <section id="homestay" class="portfolio-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h3 class="title">Homestay</h3>
                        <p class="text">Terdapat beberapa homestay di Kampung Buntal yang dibuka untuk tempahan buat percutian bekeluarga atau berkumpulan, nikmatilah penginapan yang selesa dan bersih.</p>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-menu pt-30 text-center">
                        <ul>
                            <li data-filter=".kartini-3">Kartini Homestay</li>
                            <li data-filter=".kamizan-3">Kamizan Homestay</li>
                            <li data-filter=".raniah-3">Raniah Homestay</li>
                        </ul>
                    </div> <!-- portfolio menu -->
                </div>
            </div> <!-- row -->
            <div class="row grid">
                <div class="col-lg-4 col-sm-6 raniah-3">
                    <div class="single-portfolio mt-30 wow">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/raniah1.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Bilik Tidur</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 raniah-3">
                    <div class="single-portfolio mt-30 wow">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/raniah5.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Ruang Makan</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                
                <div class="col-lg-4 col-sm-6 raniah-3">
                    <div class="single-portfolio mt-30 wow">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/raniah3.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Dapur</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                
                <div class="col-lg-4 col-sm-6 raniah-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/homestay2.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Laman Depan</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 kartini-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/kartini1.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Laman Depan</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 kartini-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/kartini3.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Dapur</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 kartini-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/kartini4.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Ruang Tamu</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 kartini-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/kartini6.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Bilik Double</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 kamizan-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/kamizan1.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Bilik Double</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 kamizan-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/kamizan2.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Bilik Single 1</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 kamizan-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/kamizan5.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Laman Depan</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 kamizan-3">
                    <div class="single-portfolio mt-30">
                        <div class="portfolio-image">
                            <img src="{{ asset('welcome_assets/images/kamizan4.jpg') }}" alt="">
                            <div class="portfolio d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Bilik Single 2</a></h4>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                 <!-- Price & Detail Cards -->
                <div class="col-lg-8 col-md-7 col-sm-9 kamizan-3">
                    <div class="pricing-style-one mt-40">
                        <div class="pricing-header text-center">
                            <h5 class="sub-title">Kamizan Homestay</h5>
                            <p class="month"><span class="price">RM 250</span>/malam</p>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li><i class="lni-check-mark-circle"></i> Satu rumah sesuai untuk sekeluarga. Mempunyai 3 Bilik dan 2 Tandas.</li>
                                <li><i class="lni-check-mark-circle"></i> Dilengkapi dapur, TV & ruang tamu.</li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="main-btn rounded-three">HUBUNGI: 013-8949570</a>
                        </div>
                    </div> <!-- pricing style one -->
                </div>
                <div class="col-lg-8 col-md-7 col-sm-9 kartini-3">
                    <div class="pricing-style-one mt-40">
                        <div class="pricing-header text-center">
                            <h5 class="sub-title">KARTINI HOMESTAY</h5>
                            <p class="month"><span class="price">RM 80</span>/malam(seorang)</p>
                            <p class="month"><span class="price">RM 150-230</span>/malam(4 orang atau lebih)</p>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li><i class="lni-check-mark-circle"></i> Rumah besar 3 bilik atau rumah sederhana 2 bilik</li>
                                <li><i class="lni-check-mark-circle"></i> Ruang tamu yang luas serta dapur serba lengkap</li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="main-btn rounded-three">HUBUNGI: 013-5614666</a>
                        </div>
                    </div> <!-- pricing style one -->
                </div>
                <div class="col-lg-8 col-md-7 col-sm-9 raniah-3">
                    <div class="pricing-style-one mt-40">
                        <div class="pricing-header text-center">
                            <h1 class="sub-title">RANIAH HOMESTAY</h>
                            <p class="month"><span class="price">RM 100</span>/malam</p>
                            <p class="month"><span class="price">RM 250</span>/malam</p>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li><i class="lni-check-mark-circle"></i> Rumah sederhana bagi 4-6 orang /rumah besar bagi 7 orang (RM100/RM250)</li>
                                <li><i class="lni-check-mark-circle"></i> Serba lengkap dengan dapur, TV, peti sejuk & ruang tamu.</li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="main-btn rounded-three">HUBUNGI: 019-4101076</a>
                        </div>
                    </div> <!-- pricing style one -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== portfolio PART ENDS ======-->

    <!--     Senarai AJK Part -->

    <section id="AJK" class="about-area" style="background-image: url({{ asset('welcome_assets/images/ajkback.jpeg') }});background-repeat:no-repeat;background-size:cover; background-attachment:fixed;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                  <!--  <div class="about-image text-center wow fadeInUp" data-wow-duration="1.5s" data-wow-offset="100">
                    </div> -->
                    <div class="section-title text-center mt-30 pb-40">
                        <h4 class="title wow">Ahli Jawatankuasa Kampung Buntal</h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.5s">
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text"> 
                                <p><b>Pemanca</b></p>
                                <ul>
                                <li>- <i>Rosidi Bin Junaidi</i></li>
                                </ul>
                                <p><b>Penghulu</b></p>
                                <ul>
                                <li><i>- Madli Bin Sah</i></li>
                                </ul>
                                <p><b>Ketua Kaum</b></p>
                                <ul>
                                <li><i>- Joni Bin Pawi</i></li>
                                </ul>
                                <p><b>Bendahari</b></p>
                                <ul>
                                <li><i>- Sauji Bin Zamari</i></li>
                                </ul>
                                <p><b>Setiausaha</b></p>
                                <ul>
                                <li><i>- Abdul Rasid Bin Bujang</i></li>
                                </ul>
                            </p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <div class="about-content media-body">
                            <h4 class="about-title"></h4>
                            <p class="text">
                                <p><b>AJK</b></p>
                                <ul>
                                <li><i>- Fauzian Bin Boh</i></li>
                                <li><i>- Saleh Bin Ben</i></li>
                                <li><i>- Ahoi Bin Serah</i></li>
                                <li><i>- Awang Hamzah Bin Awang Bujang</i></li>
                                <li><i>- Saleh Bin Ghazali</i></li>
                                <li><i>- Ustaz Hasibullah Bin Roslan</i></li>
                                <li><i>- Sarbini Bin Oren</i></li>
                                <li><i>- Hamzah Bin Jaladin</i></li>
                                <li><i>- Fuad Bin Ben</i></li>
                                <li><i>- Nazri Bin Hamid</i></li>
                                <li><i>- Wan Tambi Binti Sahari</i></li>
                                <li><i>- Puan Peah Binti Khan</i></li>
                                </ul>
                            </p>
                        </div>
                    </div> <!-- single about -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>


    <!--    Senarai AJK Part Ends Here -->
    
    <!--====== CONTACT TWO PART START ======-->

    <section id="contact" class="contact-area" style="background:white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-two mt-50 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.2s">
                        <h4 class="contact-title">Ada sebarang pertanyaan?</h4>
                        <p class="text">Hubungi <b>En. Abdul Rasid Bin Bujang</b> untuk maklumat lanjut mengenai apa lagi yang menarik di Kampung Buntal</p>
                        <ul class="contact-info">
                            <li><i class="lni-money-location"></i>Kampung Buntal, 93050 Kuching, Sarawak</li>
                            <li><i class="lni-phone-handset"></i> +60 19-8174016</li>
                            <li><i class="lni-envelope"></i> emailenwahabo@gmail.com</li>
                        </ul>
                    </div> <!-- contact two -->
                </div>
                <div class="col-lg-6">
                    <div class="mapouter"><div class="gmap_canvas"><iframe width="640" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=kampung%20buntal&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/20-off-discount-for-elegant-themes-divi-sale-coupon-code-2019/">embedgooglemap.net</a></div><style>.mapouter{position:relative;text-align:right;height:400px;width:640px;}.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:640px;}</style></div>
                 </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT TWO PART ENDS ======-->
    
    <!--====== FOOTER FOUR PART START ======-->

    <footer id="footer" class="footer-area">
        
        <div class="footer-copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="copyright text-center text-lg-left mt-10">
                            <p class="text">Made with <a style="color: #38f9d7" rel="nofollow" href="https://uideck.con"> UIdeck</a> and <a style="color: #38f9d7" rel="nofollow" href="https://ayroui.com">Ayro UI</a></p>
                        </div> <!--  copyright -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer copyright -->
    </footer>

    <!--====== FOOTER FOUR PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->  

    <!--====== PART START ======-->



    <!--====== PART ENDS ======-->










    <!--====== jquery js ======-->
    <script src="{{ asset('welcome_assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('welcome_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/js/popper.min.js') }}"></script>

    <!--====== Slick js ======-->
    <script src="{{ asset('welcome_assets/js/slick.min.js') }}"></script>

    <!--====== Isotope js ======-->
    <script src="{{ asset('welcome_assets/js/isotope.pkgd.min.js') }}"></script>

    <!--====== Images Loaded js ======-->
    <script src="{{ asset('welcome_assets/js/imagesloaded.pkgd.min.js') }}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('welcome_assets/js/jquery.magnific-popup.min.js') }}"></script>

    <!--====== Scrolling js ======-->
    <script src="{{ asset('welcome_assets/js/scrolling-nav.js') }}"></script>
    <script src="{{ asset('welcome_assets/js/jquery.easing.min.js') }}"></script>

    <!--====== wow js ======-->
    <script src="{{ asset('welcome_assets/js/wow.min.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('welcome_assets/js/main.js') }}"></script>
    

</body>

</html>
