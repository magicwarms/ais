<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>
  <meta name="description" content="Australian Intercultural School made by Andhana &amp; Kriswanto">
  <meta name="keywords" content="australian intercultural school education">
  <meta name="author" content="Andhana Utama">

  <link rel="icon" type="image/x-icon" href="{{ asset('frontend/img/logo.png') }}">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/imagehover.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.easy_slides.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
  
</head>

<body>
  <!--Navigation bar-->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a href="index.html"><img class="logo hidden-xs hidden-sm" src="{{ asset('frontend/img/logo.png') }}"></a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#home" class="link-blue-to-dark">Home</a></li>
          <li><a href="#about-ais" class="link-blue-to-dark">About AIS</a></li>
          <li><a href="#facilities" class="link-blue-to-dark">Facilities</a></li>
          <li><a href="#vision" class="link-blue-to-dark">Our Vision</a></li>
          <li><a href="#gallery" class="link-blue-to-dark">Gallery</a></li>
          <li><a href="#event" class="link-blue-to-dark">Event</a></li>
          <li><a href="#contact" class="link-blue-to-dark">Contact</a></li>
          <a href="{{ route('signin') }}"><button type="button" class="btn btn-default"><i class="fa fa-sign-in"></i> Login</button></a>
        </ul>
      </div>
    </div>
  </nav>
  <!--/ Navigation bar-->
  <!--Banner-->
  <img class="img-student hidden-xs hidden-sm img-responsive" src="{{ asset('frontend/img/student.png') }}">
  <div class="banner" id="home">
    <div class="bg-color">
      <div class="container">
        <div class="row">
          <div class="banner-text text-left">
            <div class="text-border">
              <h2 class="text-dec">Welcome to</h2>
			        <h1 class="text-dec">Australian Intercultural School</h1>
            </div>
            <div class="intro-para text-left quote">
              <div class="wrapper">
      			  <p class="lead"><b>The First International School In Batam</b>,<br> that offers the Western Australian Curriculum and Assessment Outline (K to Year 10).<br>And an Australian High School Diploma (Year 11 to 12) in the near Future.</p>
              </div>
            </div>
            <a href="#" class="buttom-more" >Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Banner-->
  <!--Feature-->
  <section id="about-ais" class="section-padding">
    <div class="container">
      <div class="row AboutUs">
        <img class="opacity-logo hidden-sm hidden-xs img-responsive" src="{{ asset('frontend/img/logo.png') }}">
        <div class="header-section text-left text-about">
          <div class="col-md-12 about-wrap">
            <div class="col-md-4">
              <h2 class="why">WHY</h2>
              <h2>Australian<br>Intercultural<br>School?</h2>
            </div>
            <div class="col-md-7 text-wrap">
              <h3 class="det-txt our-text"><span>OUR</span> ACADEMIC SYSTEM</h3>
              <hgroup>
                <h5 class="sm-txt">(Based On The Latest Western Australian Curriculum System)</h5>
              </hgroup>
              <hr class="bottom-line">
              <p class="desc">The Australian curriculum contains 8 learning areas which provide modern curriculum for every students.
              It aims to help young Australians and international students to learn live and work in the 21th century
              the Australian curriculum is a national curriculum for all primary and secondary schools in australia.
              The curriculum is developed and reviewed by the australian curriculum, assessment and reporting authority, an independent statutory body.</p>
            </div>
          </div>
          <div class="col-md-12">
            <h2 class="text-center tagline-provide">We Provide You</h2>
            <div class="feature-info">
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>Worldwide Recognition</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-globe"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>50% Coursework</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-book"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>50% Exam</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-file-text"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>International Education Standard</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-check"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>Foreign Educators</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>Affordable Education</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-money"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>Australian Education System</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-cogs"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>International Education Certificate</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-certificate"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>Competent and Compassionate Teachers</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-user-md"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>Fun and Conducive Learning Enviroment</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-smile-o"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>Complete and Modern School Facilities (Interactive Whiteboard)</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-television"></i>
                  </div>
                </div>
              </div>
              <div class="fea">
                <div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="heading pull-right text-about">
                    <h4>Emphasise on Academic Excellence And Student's Emotional Growth</h4>
                  </div>
                  <div class="fea-img pull-left">
                    <i class="fa fa-thumbs-up"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
  </section>

  <!-- Facilities -->
  <section id="facilities" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2 class="facilities">Facilities</h2>
          <p>We Enchance The Environment With Modern Facilities..</p>
        </div>
        <div class="gallery cf">
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture1.jpg') }}" />
            <h3 class="text-center img-txt">Interactive Board</h3>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture2.jpg') }}" />
            <h3 class="text-center img-txt">International Environment</h3>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture3.jpg') }}" />
            <h3 class="text-center img-txt">Sport Hall</h3>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture4.jpg') }}" />
            <h3 class="text-center img-txt">Computer Lab</h3>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture5.jpg') }}" />
            <h3 class="text-center img-txt">Library</h3>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture6.jpg') }}" />
            <h3 class="text-center img-txt">Canteen</h3>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture7.jpg') }}" />
            <h3 class="text-center img-txt">Art Room</h3>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture8.jpg') }}" />
            <h3 class="text-center img-txt">Science</h3>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('frontend/img/facilities/picture9.jpg') }}" />
            <h3 class="text-center img-txt">Multipurpose Room</h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Tutup Facilities -->
  <!-- Buka Vision & Mission -->
  <section id="vision" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-left">
          <span class="line"></span>
          <div class="col-sm-6 our-vision">
            <h1 class="visi">Vision</h1>
            <h1 class="misi">Mission</h1>
            <hr class="bottom-line tagline">
          </div>
          <div class="col-sm-6 text">
            <h1>OUR VISION</h1>
            <p>
              To Provide Quality And Holistic Education To Diverse International Group Of Students And Equip Them With Essential Knowledge And Skills As Life Learners In This Rapidly Changing World.
            </p>
            <h1>OUR MISSION</h1>
            <p>
              To Be A School Of Choice In Providing Excellent And Vibrant Australian Education System, Help Students Realize Their Potential And Become Responsible, Confident And Compassionate Participants In Global Community.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- Tutup Vision & Mission -->
  <!--/ work-shop-->
  <!--Gallery-->
  <!--/ Testimonial-->
  <!--Courses-->
  <section id="gallery" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <div class="col-md-12" style="background: #ffba5f;">
              <div class="col-md-4 text-left" style="position: relative;top: 140px;background-color: #183351;left: -15px;height: 230px;;">
                <div class="wrap">
                  <h2 class="text1">Photo</h2>
                  <span class="txt-span">&amp;</span>
                  <h2 class="text2">Video</h2>
                </div>
              </div>
              <div class="col-md-8">
                <div class="slider slider_one_big_picture">
                  <div>
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/D_-ClgWcmVQ" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                  </div>
                  <div>
                    <img src="{{ asset('frontend/img/facilities/picture1.jpg') }}" />
                  </div>
                  <div>
                    <img src="{{ asset('frontend/img/facilities/picture2.jpg') }}" />
                  </div>
                  <div>
                    <img src="{{ asset('frontend/img/facilities/picture3.jpg') }}" />
                  </div>
                  <div>
                    <img src="{{ asset('frontend/img/facilities/picture4.jpg') }}" />
                  </div>
                  <div>
                    <img src="{{ asset('frontend/img/facilities/picture5.jpg') }}" />
                  </div>
                  <div>
                    <img src="{{ asset('frontend/img/facilities/picture6.jpg') }}" />
                  </div>
                  <div>
                    <img src="{{ asset('frontend/img/facilities/picture7.jpg') }}" />
                  </div>
                  
                  <div class="nav_indicators"></div>
                 </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Gallery-->
  <section id="event" class="section-padding">
    <div class="container">
      <div class="row">
        <!-- start slider -->
          <div class="cn_wrapper">
            <div id="cn_preview" class="cn_preview">
                <div class="cn_content bg-1" style="top:0px;">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-2">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-3">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-4">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-5">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-6">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-7">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-8">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-9">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_content bg-10">
                    <div class="caption">
                        <h3><a href="blog-single.html">The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</a></h3>
                        <p>Ever since the first ‘The Hangover’ movie (which also had an equally amazing movie trailer), people across the country have been enamored by the magic of black-out drinking...</p>
                        <div class="date">
                            <P>12<br><span>March</span></P>
                        </div>
                    </div>
                </div>
                <div class="cn_nav">
                    <a id="cn_prev" class="cn_prev disabled"></a>
                    <a id="cn_next" class="cn_next"></a>
                </div>
            </div>
            <div id="cn_list" class="cn_list">
                <div class="cn_page" style="display:block;">
                    <div class="cn_item selected">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-1.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="cn_item">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-2.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>Beyoncé and Adele to perform at Michelle Obama’s 50th?</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="cn_item">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-3.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>'Iron Man 3' Secrets Revealed: Robert Downey Jr. Explains It All</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="cn_item last">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-4.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>Kristen Stewart's Bella Swan voted Britain's favourite</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="cn_page" style="display:block;">
                    <div class="cn_item selected">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-5.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="cn_item">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-6.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>Beyoncé and Adele to perform at Michelle Obama’s 50th?</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="cn_item">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-7.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>'Iron Man 3' Secrets Revealed: Robert Downey Jr. Explains It All</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="cn_item last">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-8.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>Kristen Stewart's Bella Swan voted Britain's favourite</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="cn_page" style="display:block;">
                    <div class="cn_item selected">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-9.jpg') }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>The Hangover 3: The Trilogy Finale Teaser Trailer Leaked Online</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="cn_item">
                        <div class="left-box">
                            <img src="{{ asset('frontend/img/img/slider-thumb-10.jp') }}g" alt="">
                        </div>
                        <div class="right-box">
                            <h4>Beyoncé and Adele to perform at Michelle Obama’s 50th?</h4>
                            <p>15 Comments // 12 March</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
          </div>
        <!-- end slider -->
      </div>
    </div>
  </section>
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 img-contact">
          <h3 class="txt-contact">Contact Us</h3>
          <div class="col-md-4 contact-address">
            <div class="top-box">
              <p class="address">Ruko Penuin Center Block OC No 4, City, 29453 
              Batu Selicin, Lubuk Baja 
              Kota Batam, Kepulauan Riau 29444, Indonesia</p>
              <p class="phone">+62 778 123456</p> 
              <a href="" class="email">example@info.com</a>
            </div>
            <div class="bottom-box">
              <ul>
                <li><a href="https://facebook.com/Australian-Intercultural-School-289667258212842/"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/ais_sch_id"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://www.youtube.com/channel/UCy9hzatg9QCikUvRUNTq35Q"><i class="fa fa-youtube"></i></a></li>
                <li><a href="https://instagram.com/ais.batam"><i class="fa fa-instagram"></i></a></li>
                <li><a href="https://line.me/R/ti/p/%40dau3011y"><i class="fa fa-line"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-8 form-contact">
            <form action="">
              <input type="text" id="fname" name="firstname" placeholder="Your first name..">
              <input type="text" id="lname" name="lastname" placeholder="Your last name..">
              <input type="text" id="subject" name="subject" placeholder="Subject..">
              <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
              <input type="submit" value="Submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Footer-->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="credits">
        Copyright © 2017 - {{ date('Y') }} {{ config('app.name') }}, All rights reserved.
      </div>
    </div>
  </footer>
  <!--/ Footer-->

  <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/custom.js') }}"></script>
  <script src="{{ asset('frontend/contactform/contactform.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.easy_slides.js') }}"></script>
  <script type="text/javascript">
    $('.slider_one_big_picture').EasySlides({
      'show': 5
    })
  </script>
  <script type="text/javascript" src="{{ asset('frontend/js/rumor-style/jquery-1.8.3.min.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('frontend/js/rumor-style/html5shiv.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('frontend/js/rumor-style/bootstrap.min.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('frontend/js/rumor-style/fancydropdown.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('frontend/js/rumor-style/jquery.easing-1.3.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('frontend/js/rumor-style/functions.js') }}" ></script>
  <script type="text/javascript">
      /* <![CDATA[ */
      /*global $:false */
      $(function() {
          "use strict";
          //caching
          //next and prev buttons
          var $cn_next = $('#cn_next');
          var $cn_prev    = $('#cn_prev');
          //wrapper of the left items
          var $cn_list    = $('#cn_list');
          var $pages      = $cn_list.find('.cn_page');
          //how many pages
          var cnt_pages   = $pages.length;
          //the default page is the first one
          var page        = 1;
          //list of news (left items)
          var $items      = $cn_list.find('.cn_item');
          //the current item being viewed (right side)
          var $cn_preview = $('#cn_preview');
          //index of the item being viewed. 
          //the default is the first one
          var current     = 1;
          /*
          for each item we store its index relative to all the document.
          we bind a click event that slides up or down the current item
          and slides up or down the clicked one. 
          Moving up or down will depend if the clicked item is after or
          before the current one
          */
          $items.each(function(i){
              var $item = $(this);
              $item.data('idx',i+1);
              
              $item.bind('click',function(){
                  var $this       = $(this);
                  $cn_list.find('.selected').removeClass('selected');
                  $this.addClass('selected');
                  var idx         = $(this).data('idx');
                  var $current    = $cn_preview.find('.cn_content:nth-child('+current+')');
                  var $next       = $cn_preview.find('.cn_content:nth-child('+idx+')');
                  
                  if(idx > current){
                      $current.stop().animate({'top':'-357px'},600,'easeOutBack',function(){
                          $(this).css({'top':'357px'});
                      });
                      $next.css({'top':'357px'}).stop().animate({'top':'0px'},600,'easeOutBack');
                  }
                  else if(idx < current){
                      $current.stop().animate({'top':'357px'},600,'easeOutBack',function(){
                          $(this).css({'top':'357px'});
                      });
                      $next.css({'top':'-357px'}).stop().animate({'top':'0px'},600,'easeOutBack');
                  }
                  current = idx;
              });
          });
          /*
          shows next page if exists:
          the next page fades in
          also checks if the button should get disabled
          */
          $cn_next.bind('click',function(e){
              var $this = $(this);
              $cn_prev.removeClass('disabled');
              ++page;
              if(page === cnt_pages)
                  { $this.addClass('disabled'); }
              if(page > cnt_pages){ 
                  page = cnt_pages;
                  return;
              }   
              $pages.hide();
              $cn_list.find('.cn_page:nth-child('+page+')').fadeIn();
              e.preventDefault();
          });
          /*
          shows previous page if exists:
          the previous page fades in
          also checks if the button should get disabled
          */
          $cn_prev.bind('click',function(e){
              var $this = $(this);
              $cn_next.removeClass('disabled');
              --page;
              if(page === 1)
                  { $this.addClass('disabled'); }
              if(page < 1){ 
                  page = 1;
                  return;
              }
              $pages.hide();
              $cn_list.find('.cn_page:nth-child('+page+')').fadeIn();
              e.preventDefault();
          });
      });
      /* ]]> */
  </script> 
</body>
</html>