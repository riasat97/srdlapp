<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sheikh Russel Digital Lab</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
    {{--    favicon--}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    {{--    favicon end--}}
{{--  <link href="assets/img/favicon.png" rel="icon">--}}
{{--  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">--}}

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/jsmaps/jsmaps.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h5><span><a href={{url('/')}}><img src="{{ asset('assets/img/srdl.png') }}" alt="" class="img-fluid"></a><a href={{url('/')}}>Sheikh Russel Digital Lab</a></span></h5>
            <!-- Uncomment below if you prefer to use an image logo -->
        </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto active" href="#notice">Notice</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Goals</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#faq">Vendors</a></li>
          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="nav-link scrollto" target="_blank" href="{{ route('web.selected-institutions') }}">Labs</a></li>
          <li><a class="nav-link scrollto" target="_blank" href="{{ route('notice.attachments') }}">All Notices</a></li>
          <li><a class="getstarted scrollto" href="{{url('/login')}}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-9 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up"><b style="color: purple;">Welcome to </b>Establishment of Sheikh Russel Digital Lab Project (Phase Ⅱ)</h1>
          <h5 data-aos="fade-up" data-aos-delay="400">“Sheikh Russel Digital Lab” is a flagship project of the Government of Bangladesh for meeting the demand of Digital Bangladesh aligned with SDG and for strengthening institutional capacity ensuring the quality of education by the highest use of ICT.</h5>
          <div data-aos="fade-up" data-aos-delay="800">
            <a href="{{ route('web.selected-institutions') }}" class="btn-get-started scrollto">Sheikh Russel Digital Lab list</a>
          </div>
        </div>
        <div class="col-lg-3 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="{{ asset('assets/img/srdl main.png') }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients clients">
      <div class="container">

        <div class="row">

          <div class="col-lg-4 col-md-4 col-6">
            <img src="{{asset('assets/img/government-bangladesh-logo-08FC040E6F-seeklogo.com.png') }}" style="width:112px;height:auto;" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="200">
          </div>

          <div class="col-lg-4 col-md-4 col-6">
            <img src="{{asset('assets/img/ict-division-logo-6C8E3F498E-seeklogo.com.png') }}" class="img-fluid" alt="" data-aos="zoom-in">
          </div>

          <div class="col-lg-4 col-md-4 col-6">
            <img src="{{asset('assets/img/do-ict-logo-6030E46DD4-seeklogo.com.png') }}" style="width:68px;height:auto;" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
          <!-- <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="300">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="400">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="500"> -->
          </div>

        </div>

      </div>
    </section><!-- End Clients Section -->

    <!-- ======= Notice Section ======= -->
      <section id="notice" class="notice">
          <div class="container">

              <div class="section-title" data-aos="fade-up">
                  <h2>Notice</h2>
              </div>

              <div class="row content">
                  <div class="col-lg-12" data-aos="fade-up" data-aos-delay="150">
                      <div class="box box-primary">
                          <div class="box-body">
                              @include('notices.table')
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
                      <a href="{{ route('notice.attachments') }}" class="btn btn-info">All Notices</a>
                  </div>
              </div>

          </div>
      </section><!-- End About Us Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <p>
              The Department of Information and Communication Technology has devoted special attention to the Information Technology sector in extending ICT education across the country. To ensure the use and application of ICT and to develop skilled manpower, Sheikh Russel Digital Labs are being established in various educational institutions under the direction of the Honourable Prime Minister on the initiative of the Information and Communication Technology Division and under the supervision of the Department of Information and Communication Technology (DoICT). The goals of establishing those labs are generating a conducive environment of ICT education for primary, secondary, and higher secondary students and providing informational IT training to interested youth with the prospects to acquire profitable employment opportunities at home and abroad.
            </p>
            <!-- <ul>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
              <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
            </ul> -->
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <p>
              The establishment of Sheikh Russel Digital Lab (SRDL) is being constructed under the leadership of the honourable State Minister of ICT Division, Mr. Junaid Ahmed Palak MP, and with the support of the honourable Adviser, Mr. Sajib Wazed. Sheikh Russel Digital Lab has been set up in 9001 educational institutions across the country under the overall management of the Senior Secretary of the ICT Department in collaboration with the Director-General and Project Director of the ICT Department, all Deputy Commissioners and Upazila Nirbahi Officers, District Education Officers, District-Upazila ICT Officers, Upazila Secondary Education Officers and all concerned personnel.
            </p>
            <a href="{{ route('about') }}" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>9,001 Sheikh Russel Digital Lab (2015-2023)</h2>
        </div>

{{--        <div class="row">--}}
{{--          <div class="image col-xl-6 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">--}}
{{--            <!-- <img src="assets/img/map.png" alt="" class="img-fluid"> -->--}}
{{--            <div class="jsmaps-wrapper" id="bangladesh-map" style="left: 96.4px"></div>--}}
{{--          </div>--}}

{{--          <div class="col-xl-6 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">--}}
{{--            <img src="{{ asset('assets/img/srdl stats with bg.png') }}" alt="" class="img-fluid" style="width:636px;height:480px;">--}}
{{--          </div>--}}

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">

                <div class="col-lg-6 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <div class="jsmaps-wrapper" id="bangladesh-map" style="left: 96.4px"></div>
                        <div class="portfolio-info">
                            <!-- <h4>Web 3</h4>
                            <p>Web</p> -->
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/map.png') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                                <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/img/srdl stats with bg.png') }}" class="img-fluid" alt="" style="height: 496px;">
                        <div class="portfolio-info">
                            <!-- <h4>App 2</h4>
                            <p>App</p> -->
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/srdl stats with bg.png') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                                <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
          <!-- <div class="section-title" data-aos="fade-up">
            <div><br></div>
            <h5><b>Figure: Institution type wise statistics of total 9001 computer labs established through Sheikh Russell Digital Lab Establishment (Phase 1 & Phase 2) project</b></h5>
          </div> -->
{{--      </div>--}}

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Goals and Objectives</h2>
          <p>Goals and Objectives of Sheikh Russel Digital Lab Project</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bi bi-book-half"></i></div>
              <h4 class="title"><a href="">Promotion of quality education</a></h4>
              <p class="description">Improving the quality of education and developing skilled human resources</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="ri-user-follow-line"></i></div>
              <h4 class="title"><a href="">Capacity building and self reliance</a></h4>
              <p class="description">Creating opportunities for students to become proficient in ICT and to become self-reliant</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Increasing efficiency in ICT</a></h4>
              <p class="description">Increase efficiency of students and techers in the field of ICT</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bi bi-robot"></i></div>
              <h4 class="title"><a href="https://sof.edu.bd/">School of Future (SOF)</a></h4>
              <p class="description">Developing Sheikh Russel School of Future & Preparing Digital Content</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="ri-group-fill"></i></div>
              <h4 class="title"><a href="">Seminar</a></h4>
              <p class="description">Organizing seminars to create awareness and interest in ICT through publicity and exchange of experiences </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bi bi-shield-fill-plus"></i></div>
              <h4 class="title"><a href="">Netiquette & Cyber Security</a></h4>
              <p class="description">Creating good ambience for Netiquette and Cyber Security</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bi bi-translate"></i></div>
              <h4 class="title"><a href="https://play.google.com/store/apps/details?id=com.reve.vashaguru.app">Vasha Guru APP</a></h4>
              <p class="description">Increase the efficiency of foreign language learning software</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bi bi-award-fill"></i></div>
              <h4 class="title"><a href="">Sustainability</a></h4>
              <p class="description">Future plans for sustainable project outcomes through supervision, monitoring, evaluation and research</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= More Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Principal Activies</h2>
          <p>Principal Activies of Sheikh Russel Digital Lab Project</p>
        </div>

{{--        <div class="row">--}}
{{--          <div class="image col-xl-12 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">--}}
{{--            <img src="{{ asset('assets/img/srdl main activities.png') }}" style="padding-left: 85px;" alt="" class="img-fluid">--}}
{{--          </div>--}}

{{--        </div>--}}

          <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">

              <div class="col-lg-12 col-md-12 portfolio-item filter-web">
                  <div class="portfolio-wrap">
                      <img src="{{ asset('assets/img/srdl main activities.png') }}" class="img-fluid" alt="" style="padding-left: 80px;">
                      <div class="portfolio-info">
                          <!-- <h4>Web 3</h4>
                          <p>Web</p> -->
                          <div class="portfolio-links">
                              <a href="{{ asset('assets/img/srdl main activities.png') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                              <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= More Services Section ======= -->
    <section id="more-services" class="more-services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Trainings</h2>
          <p>Training activities of Sheikh Russel Digital Lab Project</p>
        </div>

        <div class="row" >
          <div class="col-md-6 d-flex align-items-stretch">
            <div class="card" style='background-image: url("assets/img/pc-troubleshoot.jpg");' data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <h5 class="card-title"><a href="">36,020</a></h5>
                <p class="card-text">TOT training on “ICT in Education Literacy, Troubleshooting & Maintenance” to 36,020 teachers for ten days</p>
                <div class="read-more"><a href="#more-services"><i class="bi bi-arrow-right"></i> Read More</a></div>
              </div>
            </div>
          </div>
            <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                <div class="card" style='background-image: url("assets/img/fourth-industrial-revolution.jpg");' data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <h5 class="card-title"><a href="">15,000</a></h5>
                        <p class="card-text">TOT training on the use of School of Future Learning Management System (LMS), Digital Content, Attendance System etc to 15,000 teachers</p>
                        <div class="read-more"><a href="#more-services"><i class="bi bi-arrow-right"></i> Read More</a></div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 d-flex align-items-stretch mt-4">
                <div class="card" style='background-image: url("assets/img/ict\ training.jpg");' data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body">
                        <h5 class="card-title"><a href="">8703</a></h5>
                        <p class="card-text">Trained 8703 teachers on basic ICT Trained 8703 teachers on basic ICT</p>
                        <div class="read-more"><a href="#more-services"><i class="bi bi-arrow-right"></i>Read More</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-stretch mt-4">
                <div class="card" style='background-image: url("assets/img/vashaguru.jpg");' data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <h5 class="card-title"><a href="">1024</a></h5>
                        <p class="card-text">Master Trained 1024 teachers on the use of vashaguru software (9 foreign language learning software) for 20 days</p>
                        <div class="read-more"><a href="http://sheikhrusseldigitallab.gov.bd/trainees.php"><i class="bi bi-arrow-right"></i>Read More </a></div>
                    </div>
                </div>
            </div>
          <!-- <div class="col-lg-3 col-md-4">
            <div class="icon-box">
              <i class="ri-store-line" style="color: #ffbb2c;"></i>
              <h3><a href="">Trained 8703 teachers on basic ICT</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
              <h3><a href="">Trained 1024 teachers on the use of vashaguru software</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
              <h3><a href="">TOT training on “ICT in Education Literacy, Troubleshooting & Maintenance” to 36,020 teachers</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
              <h3><a href="">TOT training on the use of Learning Management System, Digital Content, Attendance System etc to 15,000 teachers</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-database-2-line" style="color: #47aeff;"></i>
              <h3><a href="">Nemo Enim</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
              <h3><a href="">Eiusmod Tempor</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
              <h3><a href="">Midela Teren</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
              <h3><a href="">Pira Neve</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-anchor-line" style="color: #b2904f;"></i>
              <h3><a href="">Dirada Pack</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-disc-line" style="color: #b20969;"></i>
              <h3><a href="">Moton Ideal</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-base-station-line" style="color: #ff5828;"></i>
              <h3><a href="">Verdo Park</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
              <h3><a href="">Flavor Nivelanda</a></h3>
            </div>
          </div> -->
        </div>

      </div>
    </section><!-- End More Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Important personal</h2>
          <p>Information and Communication Technology Division</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="{{ asset('assets/img/last-pic-adviser.jpg') }}" class="testimonial-img" alt="">
                  <h3>SAJEEB WAZED</h3>
                  <h4>Information and Communication Technology Affairs Adviser to the Hon’ble Prime Minister</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Sajeeb Wazed, is a Bangladeshi-American ICT Consultant and political campaigner. He is the son of Sheikh Hasina, the Honorable Prime Minister, Government of the People’s Republic of Bangladesh, and the eldest grandson of the first President of Bangladesh, the father of nation, the best Bengali of thousand years Bangabandhu Sheikh Mujibur Rahman. A member of the Awami League, He was a key figure in formulating the party's vision 2021 manifesto. He is currently serving as the Honorable Prime Minister’s Information and Communication Technology Affairs Adviser.Sajeeb Wazed graduated with a B.Sc. in Computer Engineering from the University of Texas at Arlington in the United States and attended the Kennedy School of Government at Harvard University, where he earned his Masters in Public Administration degree.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="{{ asset('assets/img/HSM (1).jpg') }}" class="testimonial-img" alt="">
                  <h3>Zunaid Ahmed Palak</h3>
                  <h4>MP, Minister of State for Information and Communication Technology (ICT)</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Nominated Young Global Leader in 2016 by the World Economic Forum. During his tenure, more than 18,000 government offices across the country were brought under a dedicated high speed intranet, one of the world's largest web portal consisting of 25,000 government websites established, Bangladesh won ICT’s Sustainable Development Award and WSIS plus 10 Award from ITU and Public Service Excellence Award from WITSA.
Elected Member of Parliament (MP) at the age of 28 years and became the youngest MP in the Ninth Parliament and re-elected in 2014. Minister Palak is very active in the Parliament to have an accountable government.
Secured National Award on Environment in 2010 handed over by the Prime Minister in recognition to his role in the large scale tree plantation movement.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="{{ asset('assets/img/Senior Secretary Sir.jpg') }}" class="testimonial-img" alt="">
                  <h3>Mr. N M Zeaul Alam PAA</h3>
                  <h4>the Secretary of Information & Communication Technology Division</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Mr. NM ZeaulAlam PAA is, at present, the Senior Secretary of Information and Communication Technology Division. He is the immediate past Secretary, Coordination & Reforms of the Cabinet Division. Prior to that, he was the Director General of the Department of Immigration and Passport. He started his career as Assistant Commissioner, a member of the Bangladesh Civil Service (Administration) cadre in 1986. He is from BCS-84 batch. He obtained B.Sc. (Hons.) and M.Sc. in Botany from the University of Chittagong. He did his 2nd Masters from the Brac University on Governance and Development in 2006. He served in almost all the core posts of the field administration like Magistrate, Assistant Commissioner (Land), UNO, ADC, ADM, DC and Divisional Commissioner. Besides, he served as Senior Assistant Secretary, Deputy Secretary, Joint Secretary and Addl. Secretary in different Ministries/Divisions. He was the Deputy Project Director of ‘Asrayon’, a project under the Prime Minister’s office. He also worked as Assistant Returning Officer, Returning Officer and Divisional Coordinator of National and Local Govt. level elections.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="{{ asset('assets/img/jahedi sir 2.jpg') }}" class="testimonial-img" alt="">
                  <h3>Md. Rezaul Maksud Jahedi</h3>
                  <h4>Additional Director General (Joint Secretary), Department of ICT &
                   Project Director Sheikh Russel Digital Lab</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    “Sheikh Russel Digital Lab” is a flagship project of the government of Bangladesh for meeting the demand of Digital Bangladesh and ensuring the quality & inclusive education. One of the foremost political commitments of the Hon’ble Prime minister Sheikh Hasina is to develop an educated Digital Bangladesh through positive change in the standard of the life of all walks in society by ensuring highest use of ICT. She announced to build up “A Digital Bangladesh within the year 2021” in ‘charter of Change of days’ in the year 2008. Since then Government has been adopting widespread plan to transform its’ public service delivery mechanism through information and communication technology (ICT) as the transformative driver.  The Honorable Prime Minister outlined the Digital Bangladesh having four key priorities – (a) developing human resources ready for the 21st century; (b) connecting citizens in ways most meaningful to them; (c) taking services to citizens’ doorsteps and (d) making the private sector and market more productive and competitive through the use of digital technology.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <!-- <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                  <h3>John Larson</h3>
                  <h4>Entrepreneur</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div>End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Gallery</h2>
          <p>Sheikh Russel Digital Lab Picture Gallery</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-12 d-flex justify-content-center">
            <!-- <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul> -->
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/image0.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>Web 3</h4>
                <p>Web</p> -->
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/image0.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/image2.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>App 2</h4>
                <p>App</p> -->
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/image2.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/image1.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4></h4>
                <p></p> -->
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/image1.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/image3.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>Card 2</h4>
                <p>Card</p> -->
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/image3.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/image5.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>Web 2</h4>
                <p>Web</p> -->
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/image5.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <!-- <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""> -->
              <iframe width="420" height="305" src="https://www.youtube-nocookie.com/embed/H-L1O6Qd6zA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              <div class="portfolio-info">
                <h4>Sheikh Russel Digital Lab in six minitues</h4>
                <p>Sheikh Russel Digital Lab 2015-19</p>
                <div class="portfolio-links">
                  <a href="https://www.youtube-nocookie.com/embed/H-L1O6Qd6zA" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Sheikh Russel Digital Lab in six minitues"><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/digital content.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>ডিজিটাল কনটেন্ট</h4>
                <p>শেখ রাসেল ডিজিটাল ল্যাব ও ডিজিটাল কনটেন্ট প্রস্তুতি বিষয়ে মাননীয় শিক্ষা মন্ত্রী ও উপমন্ত্রী মহোদয়ের সাথে অনুষ্ঠিত আলোচনা সভা</p>
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/digital content.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="শেখ রাসেল ডিজিটাল ল্যাব ও ডিজিটাল কনটেন্ট প্রস্তুতি বিষয়ে মাননীয় শিক্ষা মন্ত্রী ও উপমন্ত্রী মহোদয়ের সাথে অনুষ্ঠিত আলোচনা সভা"><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/state-minister.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>Card 3</h4> -->
                <p>মাননীয় প্রতিমন্ত্রীর কে, সি, আর জমিলা মজিবর রহমান উচ্চ বিদ্যালয়, সিরাজগঞ্জ সদরে স্থাপিত শেখ রাসেল ডিজিটাল ল্যাবের কক্ষ পরিদর্শন
                </p>
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/state-minister.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="মাননীয় প্রতিমন্ত্রীর কে, সি, আর জমিলা মজিবর রহমান উচ্চ বিদ্যালয়, সিরাজগঞ্জ সদরে স্থাপিত শেখ রাসেল ডিজিটাল ল্যাবের কক্ষ পরিদর্শন"><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/senior secretary.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>Web 3</h4> -->
                <p>জনাব এন এম জিয়াউল আলম পিএএ, সিনিয়র সচিব, আইসিটি বিভাগ এর লায়ন্স স্কুল এন্ড কলেজ, খুলনায় স্থাপিত শেখ রাসেল ডিজিটাল ল্যাবের কক্ষ পরিদর্শন
                </p>
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/senior secretary.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="জনাব এন এম জিয়াউল আলম পিএএ, সিনিয়র সচিব, আইসিটি বিভাগ এর লায়ন্স স্কুল এন্ড কলেজ, খুলনায় স্থাপিত শেখ রাসেল ডিজিটাল ল্যাবের কক্ষ পরিদর্শন
                  "><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/PD.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>Web 3</h4> -->
                <p>প্রকল্প পরিচালক, শেখ রাসেল ডিজিটাল ল্যাব (২য় পর্যায়)এর কিশোরগঞ্জ সরকারি বালক উচ্চ বিদ্যালয়ে ল্যাব কক্ষ পরিদর্শন
                </p>
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/PD.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="প্রকল্প পরিচালক, শেখ রাসেল ডিজিটাল ল্যাব (২য় পর্যায়)এর কিশোরগঞ্জ সরকারি বালক উচ্চ বিদ্যালয়ে ল্যাব কক্ষ পরিদর্শন
                  "><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/haor.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>Web 3</h4> -->
                <p>প্রস্তাবিত Digitalization of Island, Beel and Haor area প্রকল্প এর ডেনমার্কের টিমের  এস ও এস চিলড্রেন্স ভিলেজ, বগুড়ায় স্থাপিত ল্যাব কক্ষ পরিদর্শন
                </p>
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/haor.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="প্রস্তাবিত Digitalization of Island, Beel and Haor area প্রকল্প এর ডেনমার্কের টিমের  এস ও এস চিলড্রেন্স ভিলেজ, বগুড়ায় স্থাপিত ল্যাব কক্ষ পরিদর্শন"><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('assets/img/smart-board.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <!-- <h4>Web 3</h4> -->
                <p>শেখ রাসেল স্কুল অফ ফিউচারে স্থাপিত ডিজিটাল স্মার্ট বোর্ড
                </p>
                <div class="portfolio-links">
                  <a href="{{ asset('assets/img/smart-board.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="শেখ রাসেল স্কুল অফ ফিউচারে স্থাপিত ডিজিটাল স্মার্ট বোর্ড
                  "><i class="bx bx-plus"></i></a>
                  <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Project Employees</h2>
          <p>Officers of Sheikh Russell Digital Lab Establishment Project (Phase II)</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img mx-auto text-center">
                <img src="{{ asset('assets/img/jahedi sir.jpg') }}" class="img-fluid" alt="" style="width:306px;height:306px;">
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a> -->
                </div>
              </div>
              <div class="member-info">
                <h4>Mr. Md. Rezaul Maksud Jahedi (Joint Secretary)</h4>
                <h6>Project Director (Additional Duty)</h6>
                <div>
                  <i class="ri-phone-line"></i>
                  <p>+880241024073, +8801711166328</p>
                </div>
                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>pdsrdl@doict.gov.bd</p>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="{{ asset('assets/img/raja.jpg') }}" class="img-fluid" alt="" style="width:306px;height:306px;" >
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a> -->
                </div>
              </div>
              <div class="member-info">
                <h4>Mr. Raza Md. Abdul Hye</h4>
                <h6>Deputy Project Director (Technical) (Additional Duty)</h6>
                <div>
                  <i class="ri-phone-line"></i>
                  <p>+880241024026, +8801710873246</p>
                </div>
                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>raza6676@ictd.gov.bd</p>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="{{ asset('assets/img/hasem.jpg') }}" class="img-fluid" alt="" style="width:306px;height:306px;">
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a> -->
                </div>
              </div>
              <div class="member-info">
                <h4>Mr. Mohammad Abul Hashem</h4>
                <h6>Deputy Project Director (General) (Additional Duty)</h6>
                <div>
                  <i class="ri-phone-line"></i>
                  <p>+880255006923, +8801716223442</p>
                </div>
                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>hashem6704@gmail.com</p>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="{{ asset('assets/img/shariful_islam.jpg') }}" class="img-fluid" alt="" style="width:306px;height:306px;">
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a> -->
                </div>
              </div>
              <div class="member-info">
                <h4>Mr. Shariful Islam</h4>
                <h6>Assistant Programmer</h6>
                <div>
                  <i class="ri-phone-line"></i>
                  <p>+880241024073, +8801912436692</p>
                </div>
                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>shariful1.ap@doict.gov.bd</p>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="{{ asset('assets/img/mahbub.jpeg') }}" class="img-fluid" alt="" style="width:306px;height:306px;">
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a> -->
                </div>
              </div>
              <div class="member-info">
                <h4>Mr. Md. Mahbubur Rahman</h4>
                <h6>Assistant Programmer</h6>
                <div>
                  <i class="ri-phone-line"></i>
                  <p>+880241024073, +8801794000011</p>
                </div>
                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>mahbub.ntr@gmail.com</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="{{ asset('assets/img/riasat.jpg') }}" class="img-fluid" alt="" style="width:306px;height:306px;">
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a> -->
                </div>
              </div>
              <div class="member-info">
                <h4>Mr. Riasat Raihan Noor</h4>
                <h6>Assistant Programmer</h6>
                <div>
                  <i class="ri-phone-line"></i>
                  <p>+880241024073, +8801672702437</p>
                </div>
                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>riasatraihan@gmail.com</p>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="{{ asset('assets/img/zahid.jpg') }}" class="img-fluid" alt="" style="width:306px;height:306px;">
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a> -->
                </div>
              </div>
              <div class="member-info">
                <h4>Mr. Md. Jahidul Islam</h4>
                <h6>Assistant Programmer</h6>
                <div>
                  <i class="ri-phone-line"></i>
                  <p>+880241024073, +8801738105665</p>
                </div>
                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>zahid.ruet.cse10@gmail.com</p>
                </div>

              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->
    <!-- <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title">
          <h2>Pricing</h2>
          <p>Sit sint consectetur velit nemo qui impedit suscipit alias ea</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box" data-aos="zoom-in-right" data-aos-delay="200">
              <h3>Free</h3>
              <h4><sup>$</sup>0<span> / month</span></h4>
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li class="na">Pharetra massa</li>
                <li class="na">Massa ultricies mi</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box recommended" data-aos="zoom-in" data-aos-delay="100">
              <h3>Business</h3>
              <h4><sup>$</sup>19<span> / month</span></h4>
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li class="na">Massa ultricies mi</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in-left" data-aos-delay="200">
              <h3>Developer</h3>
              <h4><sup>$</sup>29<span> / month</span></h4>
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li>Massa ultricies mi</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>--><!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact with Vendor</h2>
        </div>

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>ওয়ালটন ডিজি-টেক ইন্ডাস্ট্রিজ লিমিটেড (Walton Digi-Tech Industries Limited)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-map-pin-line"></i>
                  <p>Plot: 1088, Block: I, Bashundhara, Vatara, PO:1229</p>
                </div>

                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>liakat@waltonbd.com</p>
                </div>

                <div>
                  <i class="ri-phone-line"></i>
                  <p>01685665033,
                    01686691447,
                    01686690413</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>ফুনা ইনফোটেক লিমিটেড (FAUNA InfoTech Limited)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-map-pin-line"></i>
                  <p>Red Crescent House (8th Floor) 61, Motijheel C/A, Dhaka-1000</p>
                </div>

                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>info@faunabd.com, faunainfotech@gmail.com </p>
                </div>

                <div>
                  <i class="ri-phone-line"></i>
                  <p>01711579182</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>টেলিফোন শিল্প সংস্থা লিমিটেড (Telephone Shilpa Sangstha Limited)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-links-line"></i>
                  <p>https://www.tss.com.bd/</p>
                </div>
                <div>
                  <i class="ri-phone-line"></i>
                  <p>01719120975</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>হাইপারট্যাগ সলিউশন লিমিটেড (HyperTag Solutions Ltd)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-map-pin-line"></i>
                  <p>Chandrashila Suvastu Tower, 69/1 Panthapath,Dhaka-1215</p>
                </div>

                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>info@hypertagsolutions.com</p>
                </div>

                <div>
                  <i class="ri-phone-line"></i>
                  <p>01813180300</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>ফ্লোরা লিমিটেড (Flora Limited)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-map-pin-line"></i>
                  <p>Plot: 1088, Block: I, Bashundhara, Vatara, PO:1229</p>
                </div>

                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>alimran@floralimited.com, ferdousi@floralimited.com</p>
                </div>

                <div>
                  <i class="ri-phone-line"></i>
                  <p>01819231608</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>হাতিল কমপ্লেক্স লিমিটেড (HATIL Complex Ltd.)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-map-pin-line"></i>
                  <p>Plot: 1088, Block: I, Bashundhara, Vatara, PO:1229</p>
                </div>

                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>info@hatil.com</p>
                </div>

                <div>
                  <i class="ri-phone-line"></i>
                  <p>01711585394</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->
        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>আরএফএল ফার্নিচার লিমিটেড (RFL Furniture Ltd.)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-map-pin-line"></i>
                  <p>PRAN-RFL Center, 105 Pragati Sarani, Middle Badda, Dhaka-1212, Bangladesh</p>
                </div>

                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>rfl412@rflgroupbd.com</p>
                </div>

                <div>
                  <i class="ri-phone-line"></i>
                  <p>01844607860</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->
        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>আকতার ফার্নিচার লিমিটেড (Akhtar Furnishers Ltd.)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-map-pin-line"></i>
                  <p>66, Progati Sarani, Baridhara,Dhaka-1212</p>
                </div>

                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>jayed@akhtargroup.com.bd</p>
                </div>

                <div>
                  <i class="ri-phone-line"></i>
                  <p>01847004756</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->
        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-6">
            <i class="ri-contacts-book-fill"></i>
            <h4>পারটেক্স ফার্নিচার ইন্ডাস্টিজ লিমিটেড (Partex Furniture Industries Ltd.)</h4>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="info">
                <div>
                  <i class="ri-map-pin-line"></i>
                  <p>222, Bir Uttam Mir Shawkat Road Gulshan, Bir Uttam Mir Shawkat Sarak, Dhaka 1208</p>
                </div>

                <div>
                  <i class="ri-mail-send-line"></i>
                  <p>shahriar@psgbd.com</p>
                </div>

                <div>
                  <i class="ri-phone-line"></i>
                  <p>01730736035</p>
                </div>

              </div>
            </div>
          </div>
        </div><!-- End F.A.Q Item-->

      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact Us</h2>
        </div>

        <div class="row">

          <!-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-about">
              <h6>Sheikh Russel Digital Lab Establishment Project</h6>
              <p>
                Website: <a href="https://srdl.gov.bd/" class="linkedin">www.srdl.gov.bd</a>
                </p>
              <div class="social-links">
                <a href="https://www.facebook.com/SRDLICT/" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/sheikhrusseldigitallab.gov.bd/" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/channel/UCf4oxjrd2RGhrsTLjB7WaOg/videos" class="youtube"><i class="bi bi-youtube"></i></a>
              </div>
            </div>
          </div> -->

          <div class="col-lg-6 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="info">
              <div>
                <i class="ri-map-pin-line"></i>
                <p>Plot # E-14/X, ICT Tower (5th Floor), Agargaon, Dhaka-1207.</p>
              </div>

              <div>
                <i class="ri-mail-send-line"></i>
                <p>pdsrdl@doict.gov.bd</p>
              </div>

              <div>
                <i class="ri-phone-line"></i>
                <p>+88-02-41024073</p>
              </div>
              <div>
                <i class="ri-links-line"></i>
                <p><a href="https://srdl.gov.bd/" class="linkedin">www.srdl.gov.bd</a></p>
              </div>
            </div>

            <div class="contact-about">
              <h6>Establishment of Sheikh Russel Digital Lab Project (Phase Ⅱ)</h6>
              <div class="social-links">
                <a href="https://www.facebook.com/SRDLICT/" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/sheikhrusseldigitallab.gov.bd/" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/channel/UCf4oxjrd2RGhrsTLjB7WaOg/videos" class="youtube"><i class="bi bi-youtube"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="300">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14604.481370248475!2d90.3744676!3d23.7787286!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfec009b60808d80a!2sICT%20Tower!5e0!3m2!1sen!2sbd!4v1664944630755!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 text-lg-left text-center">
          <div class="credits">
            <div class="col-lg-12 col-md-4 col-6">
              <img src="{{ asset('assets/img/srdl footer.png') }}" class="img-fluid" alt="" data-aos="zoom-in">
            </div>
            <div class="copyright">
              &copy; Copyright <strong>SRDL PHASE-2 PROJECT</strong>. All Rights Reserved
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
            <a href="#intro" class="scrollto">Home</a>
            <a href="#about" class="scrollto">About</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
          </nav>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script src="{{asset('assets/jsmaps/jsmaps-libs.js') }}" type="text/javascript"></script>
  <script src="{{asset('assets/jsmaps/jsmaps-panzoom.js') }}" type="text/javascript"></script>
  <script src="{{asset('assets/jsmaps/jsmaps.min.js') }}" type="text/javascript"></script>
  <script src="{{asset('assets/maps/bangladesh.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    window.JSMaps.maps.bangladesh = {
      "config": {
        "mapWidth": 900,
        "mapHeight": 700,
        "textAreaWidth": 400,
        "stateClickAction" : "url",
        //"displayMousePosition": true
        "defaultText": "<h5>4,161 Sheikh Russel Digital Lab</h5><br /><p>Bangladesh, to the east of India on the Bay of Bengal, is a South Asian country marked by lush greenery and many waterways. Its Padma (Ganges), Meghna and Jamuna rivers create fertile plains, and travel by boat is common. On the southern coast, the Sundarbans, an enormous mangrove forest shared with Eastern India, is home to the royal Bengal tiger.</p>"
      },
      "paths": [
        {
          "enable": true,
          "name": "Total Lab in Dhaka Division: 1900",
          "abbreviation": "Dhaka",
          "textX": 255,
          "textY": 287,
          "color": "#59798e",
          "hoverColor": "#E32F02",
          "selectedColor": "#feb41c",
          "url": "https://srdl.gov.bd/selected/institutions",
          "text": "<h1>Dhaka</h1><br /><p>Dhaka</p>",
          "path": "M274.9,390.6 L279.1,393.7 L280.1,396.3 L273.8,392.5 L271.3,394.9 L267.2,392.8 L262.5,387.5 L265.7,386.4 Z M292.7,366.1 L289.8,366.6 L292.7,369.2 L292.0,371.7 L288.8,370.5 L281.9,373.3 L280.2,368.6 L282.4,362.4 L285.1,361.1 L282.8,360.0 L276.9,361.9 L275.7,365.1 L272.1,365.1 L267.9,362.8 L270.3,365.9 L278.1,367.0 L279.0,368.0 L279.2,378.7 L276.3,386.4 L272.6,384.8 L251.0,380.7 L243.1,376.7 L244.0,379.4 L258.3,388.0 L262.7,393.5 L271.0,396.3 L278.2,397.1 L282.4,402.8 L283.3,409.0 L280.9,406.1 L282.0,415.4 L281.6,418.3 L277.9,423.2 L277.2,419.1 L274.7,421.9 L271.1,423.3 L265.6,423.7 L265.2,426.4 L262.1,429.4 L255.2,424.7 L251.7,423.8 L247.8,427.2 L250.6,427.2 L251.6,429.9 L248.6,434.6 L245.9,435.5 L240.8,431.3 L240.0,426.3 L236.8,423.8 L231.4,424.9 L229.5,429.0 L227.5,430.1 L221.9,436.1 L217.7,443.3 L213.5,446.8 L207.7,447.9 L203.1,445.5 L196.6,439.6 L195.5,436.4 L188.8,429.0 L185.0,421.7 L182.3,420.8 L180.4,415.9 L183.7,418.2 L188.1,410.9 L182.0,411.9 L180.3,409.8 L180.4,405.3 L174.6,403.7 L179.0,397.9 L175.7,398.0 L172.9,394.8 L171.3,390.3 L171.4,386.4 L174.5,388.2 L171.5,375.9 L165.9,372.0 L162.7,371.7 L160.9,374.3 L160.3,371.0 L163.5,368.3 L152.0,351.9 L144.5,352.2 L139.7,345.3 L145.4,330.6 L143.8,322.5 L147.4,325.0 L157.2,329.2 L164.0,334.6 L166.9,335.2 L173.9,331.8 L182.5,330.6 L181.0,321.8 L182.9,315.6 L193.7,306.5 L195.5,303.2 L197.2,293.4 L196.6,289.9 L194.6,289.4 L194.5,286.2 L188.9,280.5 L188.2,269.0 L189.3,256.0 L190.4,249.9 L190.0,246.2 L192.6,240.5 L192.1,236.7 L193.4,229.9 L192.8,225.2 L189.2,221.0 L183.0,216.8 L180.7,211.5 L177.9,197.7 L178.5,187.7 L181.0,174.9 L183.4,169.8 L187.4,164.4 L188.0,161.4 L187.0,154.9 L190.5,147.3 L193.8,145.9 L193.4,149.4 L194.7,157.7 L197.6,160.3 L201.5,158.8 L205.6,158.6 L229.7,168.8 L246.7,172.5 L255.1,176.1 L258.9,176.2 L270.0,173.8 L278.9,174.5 L284.7,173.4 L292.4,175.6 L295.6,173.6 L301.7,176.4 L304.8,176.8 L317.0,175.0 L316.7,180.1 L318.4,185.4 L314.7,196.2 L321.9,207.8 L325.0,209.2 L337.9,207.8 L340.2,215.6 L340.6,220.9 L339.9,227.1 L340.6,229.3 L346.5,229.4 L348.8,232.2 L347.1,238.1 L344.6,239.4 L346.6,243.2 L349.8,245.5 L345.1,255.0 L349.3,257.1 L349.9,261.4 L348.0,262.7 L351.9,267.4 L349.4,270.1 L350.9,272.4 L344.9,275.8 L341.6,282.1 L335.2,284.6 L335.2,288.1 L332.1,286.8 L328.5,291.8 L325.4,293.0 L325.7,295.9 L329.1,301.7 L328.3,304.2 L323.1,309.0 L322.1,317.0 L319.9,322.0 L315.8,327.8 L313.3,329.6 L308.7,327.2 L302.4,328.2 L298.5,331.3 L298.9,336.6 L295.1,346.9 L297.8,349.3 L296.2,353.6 L299.9,358.5 L296.9,359.4 L297.2,361.8 Z"
        },
        {
          "enable": true,
          "name": "Total Lab in khulna Division: 1092",
          "abbreviation": "Khulna",
          "textX": 142,
          "textY": 440,
          "color": "#B12401",
          "hoverColor": "#E32F02",
          "selectedColor": "#feb41c",
          "url":  "https://srdl.gov.bd/selected/institutions",
          "text": "<h1>Khulna</h1><br /><p></p>",
          "path": "M120.3,582.4 L119.0,584.5 L115.6,582.7 L110.0,575.9 L111.4,570.2 L109.3,562.2 L110.7,561.1 L112.3,564.3 L113.3,572.4 L114.6,575.9 L119.7,579.1 Z M213.3,495.6 L208.2,501.1 L206.7,504.9 L201.5,501.7 L202.7,508.3 L202.3,510.8 L197.7,519.7 L200.2,526.4 L201.6,538.6 L200.3,542.2 L198.5,543.2 L193.0,542.5 L197.3,545.7 L199.2,550.3 L198.9,556.0 L203.0,563.5 L202.3,565.4 L199.0,566.2 L194.9,570.5 L190.6,572.1 L189.5,569.8 L185.1,571.9 L181.1,571.4 L177.9,569.5 L176.9,566.0 L178.1,563.9 L176.3,560.5 L173.2,567.0 L176.6,572.2 L182.3,577.2 L178.6,581.2 L174.5,579.6 L170.5,580.1 L171.7,585.0 L169.6,587.2 L167.2,585.7 L164.0,580.8 L163.0,573.8 L163.3,571.1 L166.3,567.1 L167.5,563.3 L167.0,554.7 L168.5,545.4 L171.8,538.0 L170.5,533.0 L167.5,527.3 L171.9,520.9 L172.4,515.9 L174.2,511.5 L168.7,519.5 L169.7,522.3 L166.9,524.9 L165.7,528.6 L168.8,535.3 L165.7,552.2 L163.6,553.3 L162.6,546.2 L164.2,540.9 L159.2,529.0 L159.3,518.9 L157.4,516.3 L156.5,524.2 L157.3,539.2 L159.4,535.2 L162.1,541.8 L161.0,546.6 L158.9,548.6 L162.4,556.0 L161.4,562.3 L156.0,568.3 L156.1,577.5 L153.5,581.7 L148.2,585.2 L145.4,582.0 L144.6,577.2 L145.0,571.8 L147.1,566.0 L146.9,560.8 L144.4,554.7 L142.9,556.5 L144.4,561.2 L143.9,564.2 L140.2,568.7 L137.2,574.2 L135.9,572.6 L137.0,580.3 L134.7,587.3 L137.3,589.8 L134.1,592.6 L129.7,593.8 L126.9,590.4 L128.8,586.0 L125.4,576.2 L123.7,574.0 L121.5,576.7 L115.9,573.2 L113.2,563.5 L114.5,554.0 L113.8,548.7 L110.9,543.5 L111.2,535.8 L113.2,533.3 L111.5,526.0 L106.7,519.7 L105.7,517.2 L107.3,516.1 L104.9,511.4 L103.6,505.1 L105.0,500.2 L101.6,488.3 L96.9,485.8 L99.4,484.2 L99.6,478.2 L97.2,472.7 L94.9,462.8 L98.1,457.9 L99.0,450.1 L94.6,447.9 L91.0,440.6 L87.8,436.1 L88.9,422.9 L90.4,420.0 L100.4,410.1 L100.3,407.3 L97.3,407.3 L87.7,403.9 L84.4,403.7 L80.7,405.4 L73.5,403.0 L70.9,399.4 L70.9,396.8 L74.6,390.3 L80.1,376.1 L78.9,372.4 L74.8,376.0 L73.2,372.7 L68.8,369.9 L62.8,361.5 L59.7,361.5 L57.6,359.8 L58.1,356.7 L55.3,354.1 L57.7,343.3 L56.8,340.4 L59.6,334.1 L59.2,330.8 L61.4,328.3 L67.9,328.0 L74.7,321.5 L74.7,316.8 L73.4,313.1 L76.0,309.1 L73.3,307.3 L70.5,302.7 L71.5,297.7 L71.0,294.1 L72.7,291.6 L76.9,289.9 L79.0,294.4 L84.8,298.1 L89.0,298.0 L96.1,294.7 L98.6,292.3 L103.7,294.2 L110.2,301.5 L113.3,307.2 L113.2,312.2 L118.8,318.2 L123.5,320.8 L126.5,321.4 L135.6,320.5 L143.8,322.5 L145.4,330.6 L139.7,345.3 L144.5,352.2 L152.0,351.9 L163.5,368.3 L160.3,371.0 L160.9,374.3 L162.7,371.7 L165.9,372.0 L171.5,375.9 L174.5,388.2 L171.4,386.4 L171.3,390.3 L172.9,394.8 L175.7,398.0 L179.0,397.9 L174.6,403.7 L180.4,405.3 L180.3,409.8 L182.0,411.9 L188.1,410.9 L183.7,418.2 L180.4,415.9 L182.3,420.8 L185.0,421.7 L188.8,429.0 L195.5,436.4 L196.6,439.6 L203.1,445.5 L207.7,447.9 L211.4,453.0 L208.4,454.2 L207.8,458.2 L205.8,460.8 L207.7,463.0 L203.8,466.2 L203.5,468.4 L206.3,468.7 L207.7,471.6 L204.7,472.5 L207.9,478.2 L210.3,480.1 L211.0,485.9 L209.6,490.0 L211.8,491.9 Z"
        },
        {
          "enable": true,
          "name": "Total Lab in Barisal Division: 711",
          "abbreviation": "Barisal",
          "textX": 241,
          "textY": 493,
          "color": "#9a9a68",
          "hoverColor": "#E32F02",
          "selectedColor": "#feb41c",
          "url": "https://srdl.gov.bd/selected/institutions",
          "text": "<h1>Barisal</h1><br /><p></p>",
          "path": "M281.3,559.2 L280.2,561.9 L278.5,561.3 L275.7,566.3 L273.5,568.0 L271.6,567.0 L274.7,566.2 L272.3,563.7 L274.1,558.2 L281.5,553.1 L283.0,558.7 Z M252.5,569.5 L251.0,569.9 L251.4,561.5 L254.9,554.3 L259.4,551.5 L259.0,554.1 L256.2,558.8 L253.6,568.2 Z M254.0,554.8 L255.4,548.8 L258.6,545.8 L257.9,548.8 L254.8,552.4 Z M263.6,562.5 L260.3,562.6 L259.4,558.8 L261.3,554.4 L261.3,548.1 L263.2,545.8 L268.2,551.1 L269.6,554.3 L268.5,558.0 Z M283.7,531.9 L281.5,539.2 L280.7,535.9 L277.8,548.6 L275.4,551.4 L272.1,551.6 L271.5,548.6 L276.0,544.1 L275.4,543.3 L269.3,547.3 L270.2,541.9 L274.8,538.4 L277.7,535.1 Z M321.4,526.4 L321.8,534.0 L320.9,536.8 L318.8,537.3 L317.7,532.2 L319.4,525.9 Z M325.2,527.9 L323.9,529.1 L324.6,520.3 L326.2,521.0 Z M325.4,517.7 L321.3,524.2 L319.5,523.5 L321.7,518.2 L322.0,512.7 L323.8,507.9 L325.7,512.8 Z M285.7,500.0 L288.6,506.2 L286.5,507.8 L287.3,512.6 L284.2,500.8 L282.2,500.3 L282.9,497.8 Z M288.0,500.0 L287.3,500.8 L287.9,493.8 L289.5,499.1 Z M307.5,533.2 L301.6,542.3 L299.7,544.0 L298.9,542.3 L295.3,545.6 L292.4,550.6 L287.5,552.1 L286.6,549.5 L291.3,539.2 L285.1,548.2 L283.3,548.6 L283.1,542.8 L285.9,536.8 L284.6,534.1 L285.7,529.7 L290.3,519.7 L291.2,515.4 L291.2,508.5 L291.8,506.4 L288.5,488.9 L287.2,486.1 L279.2,480.1 L277.4,479.6 L277.1,471.1 L279.5,461.2 L281.5,459.0 L287.5,457.6 L289.8,465.3 L294.7,475.3 L298.2,480.2 L299.1,486.0 L300.5,489.7 L308.0,496.7 L310.3,499.5 L308.1,510.8 L308.4,530.1 Z M282.6,446.9 L286.8,450.2 L290.5,455.1 L280.9,454.4 L274.3,459.8 L274.7,464.6 L273.2,466.7 L270.0,461.7 L265.9,460.0 L267.0,457.6 L267.0,450.0 L269.3,447.8 L274.9,448.2 L275.7,446.5 Z M286.8,435.2 L289.2,437.8 L285.5,437.8 L289.2,442.0 L285.8,441.6 L280.5,436.8 L278.8,437.9 L273.4,437.9 L271.6,435.2 L273.8,431.4 L277.5,428.4 L280.2,428.1 Z M268.3,430.8 L267.4,431.4 L265.8,424.8 L271.9,424.1 L272.4,426.1 Z M265.2,426.4 L267.2,432.8 L271.5,439.2 L271.9,442.1 L275.2,444.6 L273.0,446.6 L268.2,446.1 L266.1,448.8 L263.7,456.1 L260.6,456.8 L262.4,458.4 L260.5,460.6 L259.1,459.2 L256.7,460.8 L263.7,464.1 L266.6,462.3 L269.7,465.7 L271.9,474.4 L272.3,478.6 L270.9,480.9 L266.4,482.5 L264.5,490.9 L266.8,489.4 L266.5,485.8 L269.5,481.9 L273.6,482.0 L277.5,484.4 L279.5,487.9 L282.8,495.9 L280.5,495.1 L280.5,497.8 L283.5,504.1 L284.2,509.0 L283.6,513.9 L280.1,523.1 L277.5,527.2 L271.2,530.4 L269.8,535.0 L266.6,540.5 L264.3,542.5 L258.6,539.3 L261.9,530.7 L262.4,527.8 L260.8,522.9 L261.1,517.6 L259.8,519.6 L258.9,526.6 L261.4,530.3 L257.8,534.4 L256.2,541.9 L252.5,547.0 L249.9,553.4 L247.9,564.6 L245.9,568.5 L239.8,573.8 L236.1,575.3 L225.9,571.8 L226.2,568.3 L229.6,563.3 L228.5,561.2 L226.5,566.0 L223.0,569.0 L218.3,568.0 L219.3,558.3 L220.6,555.6 L225.1,551.5 L227.3,545.1 L234.8,537.6 L237.2,538.5 L239.6,536.9 L242.1,531.0 L241.8,527.9 L238.4,535.7 L232.0,538.4 L225.4,545.5 L221.4,552.9 L215.2,551.5 L216.8,546.7 L219.5,544.5 L219.4,539.0 L213.6,546.3 L213.6,553.2 L212.0,554.6 L208.3,551.8 L206.1,544.2 L205.8,535.4 L204.3,526.3 L202.3,522.9 L202.3,517.2 L204.5,511.8 L213.7,498.5 L215.3,494.3 L213.3,495.6 L211.8,491.9 L209.6,490.0 L211.0,485.9 L210.3,480.1 L207.9,478.2 L204.7,472.5 L207.7,471.6 L206.3,468.7 L203.5,468.4 L203.8,466.2 L207.7,463.0 L205.8,460.8 L207.8,458.2 L208.4,454.2 L211.4,453.0 L207.7,447.9 L213.5,446.8 L217.7,443.3 L221.9,436.1 L227.5,430.1 L229.5,429.0 L231.4,424.9 L236.8,423.8 L240.0,426.3 L240.8,431.3 L245.9,435.5 L248.6,434.6 L251.6,429.9 L250.6,427.2 L247.8,427.2 L251.7,423.8 L255.2,424.7 L262.1,429.4 Z"
        },
        {
          "enable": true,
          "name": "Total Lab in Chattogram Division: 1671",
          "abbreviation": "Chittagong",
          "textX": 324,
          "textY": 404,
          "color": "#59798e",
          "hoverColor": "#E32F02",
          "selectedColor": "#feb41c",
          "url": "https://srdl.gov.bd/selected/institutions",
          "text": "<h1>Chittagong</h1><br /><p></p>",
          "path": "M431.5,584.2 L435.6,592.0 L436.7,596.7 L435.3,607.0 L434.3,609.1 L426.9,609.1 L427.5,611.5 L425.0,612.2 L422.5,606.8 L424.2,604.2 L423.8,595.3 L421.4,587.4 L422.0,583.0 L424.0,579.5 L428.2,582.8 L427.2,577.2 L431.0,576.3 Z M420.6,581.9 L418.7,581.1 L420.3,571.1 L419.4,565.1 L420.6,561.4 L423.2,558.4 L425.4,564.6 L425.2,568.1 Z M335.8,539.1 L333.7,540.5 L329.1,539.9 L327.2,537.3 L330.4,533.5 L333.1,528.3 L334.1,522.5 L334.7,504.8 L336.6,504.5 L342.9,508.5 L345.5,513.0 L347.3,523.9 L342.3,533.7 Z M344.0,497.4 L338.9,496.1 L340.0,492.8 L348.4,489.7 L349.7,492.0 L348.6,494.8 Z M387.9,502.8 L382.6,503.5 L379.1,501.5 L375.8,496.8 L373.2,488.2 L375.7,482.1 L378.0,480.9 L388.0,493.7 L388.8,498.8 Z M358.9,313.4 L355.1,314.0 L352.5,316.9 L348.9,323.6 L348.5,326.9 L350.2,331.1 L346.7,341.8 L340.9,343.7 L340.3,348.6 L343.9,350.2 L343.6,353.9 L340.7,354.0 L340.9,358.9 L344.1,364.9 L346.9,372.8 L350.5,376.0 L354.0,387.3 L356.9,388.7 L354.9,392.5 L356.2,395.6 L358.9,414.8 L360.4,419.7 L363.1,423.3 L366.8,424.2 L367.1,420.3 L365.0,410.3 L364.9,405.0 L366.7,400.5 L371.3,402.0 L374.9,408.0 L376.8,409.6 L381.4,426.3 L383.0,427.3 L383.2,430.9 L385.1,433.7 L389.6,435.2 L390.7,438.1 L394.0,434.0 L397.3,434.2 L402.6,432.7 L407.4,428.3 L409.2,423.9 L411.5,423.4 L413.6,420.5 L411.7,415.5 L409.9,407.3 L408.3,403.5 L407.6,398.8 L409.6,392.9 L412.7,387.3 L417.3,381.8 L423.4,379.1 L426.5,376.2 L428.9,371.9 L429.1,367.3 L426.0,353.5 L426.6,344.8 L428.1,344.7 L435.6,353.7 L437.3,354.5 L441.7,352.2 L447.0,345.1 L451.6,343.4 L453.8,346.7 L456.5,353.3 L458.2,351.7 L459.5,346.1 L463.6,346.2 L462.7,353.9 L463.0,357.8 L467.5,371.4 L468.2,377.2 L470.8,381.2 L472.2,386.4 L474.2,389.2 L475.1,395.8 L472.1,405.2 L472.1,409.9 L475.2,426.7 L475.2,435.0 L476.1,439.1 L478.3,442.1 L483.6,445.6 L485.5,458.4 L489.9,462.7 L491.6,466.4 L492.6,475.5 L492.4,482.5 L494.6,490.2 L501.7,529.0 L501.6,532.1 L497.4,533.9 L500.0,541.9 L503.7,559.0 L504.0,562.6 L502.4,580.9 L504.5,609.3 L506.1,618.3 L510.8,632.7 L507.7,637.0 L502.8,638.9 L501.4,637.5 L499.7,630.2 L497.4,625.4 L486.1,625.3 L481.4,622.9 L479.8,616.9 L474.7,613.8 L470.5,618.9 L465.1,619.3 L462.5,626.7 L459.4,631.3 L458.9,635.7 L459.7,640.4 L458.7,648.1 L460.2,651.9 L462.9,654.3 L464.3,657.9 L469.0,661.7 L468.2,671.2 L470.0,680.4 L473.3,685.3 L477.5,697.8 L476.3,700.0 L473.5,697.2 L470.8,691.1 L463.0,677.3 L461.0,669.6 L454.3,663.5 L450.1,656.6 L445.0,650.8 L444.0,646.4 L444.8,638.7 L444.0,633.6 L437.7,622.4 L434.3,618.9 L433.1,614.8 L434.6,615.5 L436.7,611.1 L439.2,609.2 L437.4,602.4 L441.0,597.9 L442.4,589.6 L440.9,588.6 L438.5,591.9 L435.7,590.4 L436.6,586.7 L434.2,587.2 L432.7,584.1 L434.6,579.3 L434.5,576.5 L437.1,574.6 L428.0,576.3 L427.0,575.4 L428.3,570.0 L430.2,568.9 L430.3,564.7 L428.7,566.6 L426.6,556.8 L424.7,554.0 L424.6,549.5 L421.6,537.3 L421.4,533.2 L419.9,536.4 L417.6,531.8 L416.7,525.9 L419.7,520.9 L419.5,519.0 L416.6,516.8 L416.2,513.9 L423.4,510.2 L427.0,499.6 L424.7,499.6 L423.7,507.0 L420.0,510.4 L415.0,513.2 L414.6,516.3 L418.2,518.4 L418.2,520.7 L413.9,522.1 L412.1,519.4 L410.0,505.8 L408.8,501.5 L401.1,486.8 L386.8,467.2 L381.3,464.1 L376.5,457.3 L380.1,445.8 L380.1,442.9 L377.1,451.4 L372.1,455.5 L372.0,461.0 L368.7,459.0 L364.4,458.6 L367.0,461.2 L364.0,462.8 L358.3,463.0 L362.9,465.1 L361.3,467.8 L353.2,467.8 L353.0,465.2 L346.2,464.5 L348.2,467.8 L344.8,469.4 L354.2,472.3 L355.5,474.6 L353.0,482.4 L348.7,486.3 L340.4,488.3 L336.1,486.3 L334.0,483.0 L332.7,477.9 L328.2,469.8 L330.7,478.7 L328.2,482.2 L321.3,482.6 L316.1,477.6 L313.4,473.3 L312.5,469.9 L308.0,469.7 L306.2,464.7 L303.4,463.0 L301.1,458.6 L298.4,449.3 L295.7,443.4 L294.8,439.3 L286.2,427.7 L284.7,421.9 L286.7,407.1 L289.1,400.3 L287.2,396.5 L287.5,392.9 L284.7,393.9 L282.8,391.4 L281.5,385.6 L281.6,378.6 L282.5,375.9 L285.2,374.2 L291.6,374.2 L294.2,372.8 L294.2,368.4 L292.7,366.1 L297.2,361.8 L296.9,359.4 L299.9,358.5 L296.2,353.6 L297.8,349.3 L295.1,346.9 L298.9,336.6 L298.5,331.3 L302.4,328.2 L308.7,327.2 L313.3,329.6 L315.8,327.8 L319.9,322.0 L322.1,317.0 L323.1,309.0 L328.3,304.2 L329.1,301.7 L325.7,295.9 L325.4,293.0 L328.5,291.8 L332.1,286.8 L335.2,288.1 L335.2,284.6 L341.6,282.1 L350.7,286.7 L353.4,287.2 L357.0,284.1 L361.2,284.5 L356.3,288.0 L356.2,289.7 L359.6,291.1 L355.0,293.3 L356.6,303.6 L359.3,309.6 Z"
        },
        {
          "enable": true,
          "name": "Total Lab in Sylhet Division: 587",
          "abbreviation": "Sylhet",
          "textX": 399,
          "textY": 231,
          "color": "#B12401",
          "hoverColor": "#E32F02",
          "selectedColor": "#feb41c",
          "url": "https://srdl.gov.bd/selected/institutions",
          "text": "<h1>Sylhet</h1><br /><p></p>",
          "path": "M341.6,282.1 L344.9,275.8 L350.9,272.4 L349.4,270.1 L351.9,267.4 L348.0,262.7 L349.9,261.4 L349.3,257.1 L345.1,255.0 L349.8,245.5 L346.6,243.2 L344.6,239.4 L347.1,238.1 L348.8,232.2 L346.5,229.4 L340.6,229.3 L339.9,227.1 L340.6,220.9 L340.2,215.6 L337.9,207.8 L325.0,209.2 L321.9,207.8 L314.7,196.2 L318.4,185.4 L316.7,180.1 L317.0,175.0 L321.4,173.6 L338.7,170.7 L344.8,170.8 L349.6,169.3 L354.9,172.0 L371.0,176.7 L375.2,177.2 L385.5,173.9 L388.8,177.6 L396.0,177.7 L397.6,174.7 L401.2,175.6 L403.3,172.8 L410.2,173.0 L421.8,171.4 L427.8,172.2 L432.8,170.6 L436.3,170.7 L442.7,172.6 L445.2,175.6 L452.1,177.0 L456.6,181.2 L465.7,183.0 L468.5,186.1 L474.3,188.9 L475.0,192.3 L482.8,197.1 L481.9,198.0 L485.6,200.1 L486.9,204.0 L485.1,207.8 L474.6,211.2 L464.7,204.9 L460.5,203.5 L457.3,205.0 L456.8,207.0 L458.8,212.9 L458.7,218.5 L453.4,234.2 L452.0,242.9 L450.4,246.5 L445.8,250.1 L445.3,252.4 L446.0,259.7 L445.7,263.1 L443.6,266.0 L437.6,267.6 L428.5,267.0 L431.0,274.0 L425.5,270.7 L423.1,271.5 L422.7,273.6 L423.9,280.7 L421.7,290.9 L419.5,293.9 L417.3,293.4 L413.9,290.1 L413.1,285.6 L405.0,284.1 L403.9,285.7 L405.1,292.4 L401.9,295.0 L397.8,293.5 L394.8,286.9 L393.2,287.9 L392.1,295.5 L390.3,299.7 L386.1,301.6 L377.6,301.9 L369.3,300.1 L364.7,300.6 L363.4,303.6 L362.2,313.1 L358.9,313.4 L359.3,309.6 L356.6,303.6 L355.0,293.3 L359.6,291.1 L356.2,289.7 L356.3,288.0 L361.2,284.5 L357.0,284.1 L353.4,287.2 L350.7,286.7 Z"
        },
        {
          "enable": true,
          "name": "Total Lab in Rajshahi Division: 1252",
          "abbreviation": "Rajshahi",
          "textX": 109,
          "textY": 235,
          "color": "#9a9a68",
          "hoverColor": "#E32F02",
          "selectedColor": "#feb41c",
          "url": "https://srdl.gov.bd/selected/institutions",
          "text": "<h1>Rajshahi</h1><br /><p></p>",
          "path": "M181.0,174.9 L178.5,187.7 L177.9,197.7 L180.7,211.5 L183.0,216.8 L189.2,221.0 L192.8,225.2 L193.4,229.9 L192.1,236.7 L192.6,240.5 L190.0,246.2 L190.4,249.9 L189.3,256.0 L188.2,269.0 L188.9,280.5 L194.5,286.2 L194.6,289.4 L196.6,289.9 L197.2,293.4 L195.5,303.2 L193.7,306.5 L182.9,315.6 L181.0,321.8 L182.5,330.6 L173.9,331.8 L166.9,335.2 L164.0,334.6 L157.2,329.2 L147.4,325.0 L143.8,322.5 L143.8,322.5 L135.6,320.5 L126.5,321.4 L123.5,320.8 L118.8,318.2 L113.2,312.2 L113.3,307.2 L110.2,301.5 L103.7,294.2 L98.6,292.3 L96.1,294.7 L89.0,298.0 L84.8,298.1 L79.0,294.4 L76.9,289.9 L78.9,286.0 L77.6,278.4 L75.1,275.0 L69.2,272.2 L66.4,277.4 L64.0,277.5 L58.6,275.7 L49.0,274.7 L41.0,268.2 L12.5,252.8 L9.4,252.1 L6.7,247.2 L6.8,241.0 L3.8,236.1 L0.0,234.7 L0.6,231.1 L3.0,226.9 L3.6,221.7 L6.2,221.0 L7.5,216.8 L9.6,216.3 L13.3,211.1 L10.6,202.5 L16.0,199.7 L20.2,199.2 L24.4,204.8 L24.4,207.0 L32.1,208.6 L39.0,199.4 L40.7,193.5 L44.6,186.9 L45.6,179.1 L45.4,172.4 L46.5,170.4 L50.2,169.8 L59.3,172.8 L63.6,170.2 L70.7,171.0 L77.2,173.5 L83.6,174.2 L87.2,170.0 L96.1,173.3 L98.8,173.5 L97.3,171.0 L99.3,170.6 L99.4,166.2 L104.5,162.0 L104.5,157.5 L126.9,158.0 L131.4,159.1 L131.7,163.7 L134.4,169.8 L137.9,173.2 L145.1,169.1 L151.7,170.6 L162.0,174.1 L172.7,174.1 Z"
        },
        {
          "enable": true,
          "name": "Total Lab in Rangpur Division: 981",
          "abbreviation": "Rangpur",
          "textX": 108,
          "textY": 96,
          "color": "#59798e",
          "hoverColor": "#E32F02",
          "selectedColor": "#feb41c",
          "url":  "https://srdl.gov.bd/selected/institutions",
          "text": "<h1>Rangpur</h1><br /><p></p>",
          "path": "M181.0,174.9 L172.7,174.1 L162.0,174.1 L151.7,170.6 L145.1,169.1 L137.9,173.2 L134.4,169.8 L131.7,163.7 L131.4,159.1 L126.9,158.0 L104.5,157.5 L96.7,157.3 L94.2,154.9 L90.8,154.5 L87.6,150.6 L85.5,145.5 L87.4,141.3 L87.3,138.8 L82.7,133.5 L79.4,132.2 L79.5,134.3 L75.6,134.7 L72.5,137.7 L68.9,137.5 L63.4,134.2 L56.5,133.5 L51.7,128.4 L50.7,126.0 L45.1,122.4 L44.7,115.0 L41.9,111.8 L34.1,106.4 L27.7,98.7 L24.2,96.8 L13.4,100.2 L9.2,93.4 L7.9,84.2 L9.4,82.4 L11.5,75.7 L13.6,71.7 L16.4,69.6 L17.0,66.0 L15.3,63.2 L17.9,56.6 L23.9,52.0 L33.6,49.0 L36.4,46.1 L36.7,40.0 L40.0,36.3 L45.1,33.2 L47.1,30.6 L48.9,31.6 L54.2,31.8 L54.0,28.7 L50.4,19.7 L47.5,18.3 L38.9,15.9 L36.9,20.2 L34.6,16.2 L36.7,12.2 L38.9,4.6 L41.1,0.7 L43.5,0.0 L43.7,7.1 L45.1,8.7 L50.6,10.7 L55.3,15.7 L59.9,18.3 L64.4,18.9 L66.5,22.6 L71.3,24.5 L70.8,27.3 L72.6,28.0 L73.1,31.0 L76.9,33.5 L76.2,37.1 L70.0,41.1 L71.9,42.5 L81.0,39.2 L84.8,40.8 L87.4,46.3 L90.9,46.5 L92.5,42.6 L94.7,41.2 L97.6,41.7 L102.3,46.5 L105.4,47.6 L112.3,44.9 L111.7,42.7 L108.5,41.5 L108.9,38.9 L105.4,38.6 L104.5,35.2 L98.7,32.7 L96.5,30.3 L97.4,26.0 L100.1,22.8 L102.9,22.2 L109.3,27.8 L112.9,29.0 L114.1,33.0 L118.4,34.5 L119.2,37.0 L115.5,36.9 L115.5,40.1 L119.1,47.6 L120.0,54.8 L122.1,58.5 L129.2,61.7 L131.9,64.2 L133.5,67.6 L137.3,69.4 L139.8,72.4 L145.7,75.0 L150.0,72.8 L151.6,75.2 L161.2,75.3 L163.6,79.2 L167.0,78.4 L168.1,72.0 L172.8,68.1 L172.9,64.6 L170.0,64.8 L168.9,62.9 L173.0,60.3 L169.2,59.2 L168.5,57.7 L171.1,54.5 L174.1,55.1 L173.2,49.5 L176.3,47.8 L178.8,49.9 L178.8,55.7 L184.0,56.4 L188.6,64.7 L188.7,69.8 L192.9,76.2 L195.5,75.2 L196.8,78.8 L193.1,80.8 L197.7,82.9 L197.2,85.7 L192.6,93.9 L192.2,96.9 L194.1,107.6 L196.6,113.6 L197.7,118.3 L196.6,126.7 L196.4,135.7 L193.8,145.9 L190.5,147.3 L187.0,154.9 L188.0,161.4 L187.4,164.4 L183.4,169.8 Z"
        }
      ],

    }
    JSMaps.maps.bangladesh.pins = [
        {
          "name": "Total Lab in Rangpur Division: 981",
          "xPos": 104,
          "yPos": 76,
          "color": '#ff0000',
          "hoverColor": '#ff0000',
          "selectedColor": '#ff0000',
        "url": "https://srdl.gov.bd/selected/institutions",
        "text": "<h1>Sample pin</h1><br /><p>sample pin</p>"
        },
        {
          "name": " Total Lab in Dhaka Division: 1900",
          "xPos": 232,
          "yPos": 310,
          "color": '#ff0000',
          "hoverColor": '#ff0000',
          "selectedColor": '#ff0000',
          "url": "https://srdl.gov.bd/selected/institutions"
        },
        {
          "name": " Total Lab in Mymensingh Division: 807",
          "xPos": 292,
          "yPos": 238,
          "color": '#ff0000',
          "hoverColor": '#ff0000',
          "selectedColor": '#ff0000',
          "url": "https://srdl.gov.bd/selected/institutions"
        },
        {
          "name": " Total Lab in Sylhet Division: 587",
          "xPos": 400,
          "yPos": 210,
          "color": '#ff0000',
          "hoverColor": '#ff0000',
          "selectedColor": '#ff0000',
          "url": "https://srdl.gov.bd/selected/institutions"
        },
        {
          "name": " Total Lab in Rajshahi Division: 1252",
          "xPos": 108,
          "yPos": 210,
          "color": '#ff0000',
          "hoverColor": '#ff0000',
          "selectedColor": '#ff0000',
          "url": "https://srdl.gov.bd/selected/institutions"
        },
        {
          "name": " Total Lab in khulna Division: 1092",
          "xPos": 144,
          "yPos": 420,
          "color": '#ff0000',
          "hoverColor": '#ff0000',
          "selectedColor": '#ff0000',
        "url": "https://srdl.gov.bd/selected/institutions",
        "text": "<h1>Paris</h1><br /><p>Lorem ipsum dolor sit amet.</p>"
        },
        {
          "name": " Total Lab in Barisal Division: 711",
          "xPos": 246,
          "yPos": 472,
          "color": '#ff0000',
          "hoverColor": '#ff0000',
          "selectedColor": '#ff0000',
          "url": "https://srdl.gov.bd/selected/institutions"
        },
        {
          "name": " Total Lab in Chattogram Division: 1671",
          "xPos": 322,
          "yPos": 370,
          "color": '#ff0000',
          "hoverColor": '#ff0000',
          "selectedColor": '#ff0000',
          "url": "https://srdl.gov.bd/selected/institutions"
        },
      ];

        $(function() {


          $('#bangladesh-map').JSMaps({
        map: 'bangladesh',
        //"displayMousePosition": true,

          });

        });

      </script>
</body>

</html>