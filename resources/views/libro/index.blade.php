<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Libro - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="libro/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="libro/css/animate.css">
    
    <link rel="stylesheet" href="libro/css/owl.carousel.min.css">
    <link rel="stylesheet" href="libro/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="libro/css/magnific-popup.css">

    <link rel="stylesheet" href="libro/css/aos.css">

    <link rel="stylesheet" href="libro/css/ionicons.min.css">

    <link rel="stylesheet" href="libro/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="libro/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="libro/css/flaticon.css">
    <link rel="stylesheet" href="libro/css/icomoon.css">
    <link rel="stylesheet" href="libro/css/style.css">
  </head>
  <body>

    <nav id="colorlib-main-nav" role="navigation">
      <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle active"><i></i></a>
      <div class="js-fullheight colorlib-table">
        <div class="colorlib-table-cell js-fullheight">
          <div class="row d-flex justify-content-end">
            <div class="col-md-12 px-5">
              <ul class="mb-5">
                <li class="active"><a href="index.html"><span>Home</span></a></li>
                @foreach ($data['cat'] as $cat=>$id)
                <li><a href="/home/{{ $cat}}"><span>{{ $id }}</span></a></li>
                @endforeach
              </ul>
            </div>
            <div class="col px-5 copyright">
            	<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <br> | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
            </div>
          </div>
        </div>
      </div>
    </nav>
    
    <div id="colorlib-page">
      <header>
      	<div class="container-fluid">
	        <div class="row no-gutters">
	          <div class="col-md-12">
	            <div class="colorlib-navbar-brand">
	              <a class="colorlib-logo" href="index.html">Libro</a>
	            </div>
	            <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
	          </div>
	        </div>
        </div>
      </header>

      <section class="ftco-fixed clearfix">
      	<div class="image js-fullheight float-left">
      		<div class="home-slider owl-carousel js-fullheight">
		        <div class="slider-item js-fullheight" style="background-image: url('images/bg_1.jpg');">
		          <div class="overlay"></div>
		          <div class="container">
		            <div class="row slider-text align-items-end" data-scrollax-parent="true">
		              <div class="col-md-10 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		              	<p class="cat"><span>Fashion</span></p>
		                <h1 class="mb-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Popular Lifestyle with Fashion &amp; Modeling</h1>
		              </div>
		            </div>
		          </div>
		        </div>

		        <div class="slider-item js-fullheight" style="background-image: url('images/bg_2.jpg');">
		          <div class="overlay"></div>
		          <div class="container">
		            <div class="row slider-text align-items-end" data-scrollax-parent="true">
		              <div class="col-md-10 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		              	<p class="cat"><span>Model</span></p>
		                <h1 class="mb-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Canadian Girl make your world go round</h1>
		              </div>
		            </div>
		          </div>
		        </div>
				  <div class="slider-item js-fullheight" style="background-image: url('images/bg_1.jpg');">
		          <div class="overlay"></div>
		          <div class="container">
		            <div class="row slider-text align-items-end" data-scrollax-parent="true">
		              <div class="col-md-10 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		              	<p class="cat"><span>Fashion</span></p>
		                <h1 class="mb-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">hhhhhhhhhhhhhhhhhhhhhhhhhhhh</h1>
		              </div>
		            </div>
		          </div>
		        </div>
				
				
		      </div>
      	</div>
      	<div class="page-container float-right">
      		<div class="row">
      			<div class="col-md-6">
      				<div class="blog-entry ftco-animate">
                <a href="blog-single.html" class="blog-image">
                	<img src="images/image_1.jpg" class="img-fluid" alt="">
                </a>
                <div class="text py-4">
                  <div class="meta">
                    <div><a href="#">July 29, 2018</a></div>
                    <div><a href="#">Admin</a></div>
                  </div>
                  <h3 class="heading"><a href="#">Life looks happier</a></h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="blog-entry ftco-animate">
                <a href="blog-single.html" class="blog-image">
                	<img src="images/image_2.jpg" class="img-fluid" alt="">
                </a>
                <div class="text py-4">
                  <div class="meta">
                    <div><a href="#">July 29, 2018</a></div>
                    <div><a href="#">Admin</a></div>
                  </div>
                  <h3 class="heading"><a href="#">Life looks happier</a></h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="blog-entry ftco-animate">
                <a href="blog-single.html" class="blog-image">
                	<img src="images/image_3.jpg" class="img-fluid" alt="">
                </a>
                <div class="text py-4">
                  <div class="meta">
                    <div><a href="#">July 29, 2018</a></div>
                    <div><a href="#">Admin</a></div>
                  </div>
                  <h3 class="heading"><a href="#">Life looks happier</a></h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
							<div class="blog-entry ftco-animate">
                <a href="blog-single.html" class="blog-image">
                	<img src="images/image_4.jpg" class="img-fluid" alt="">
                </a>
                <div class="text py-4">
                  <div class="meta">
                    <div><a href="#">July 29, 2018</a></div>
                    <div><a href="#">Admin</a></div>
                  </div>
                  <h3 class="heading"><a href="#">Life looks happier</a></h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
      			</div>

      			<div class="col-md-6">
      				<div class="blog-entry ftco-animate">
                <a href="blog-single.html" class="blog-image">
                	<img src="images/image_5.jpg" class="img-fluid" alt="">
                </a>
                <div class="text py-4">
                  <div class="meta">
                    <div><a href="#">July 29, 2018</a></div>
                    <div><a href="#">Admin</a></div>
                  </div>
                  <h3 class="heading"><a href="#">Life looks happier</a></h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="blog-entry ftco-animate">
                <a href="blog-single.html" class="blog-image">
                	<img src="images/image_6.jpg" class="img-fluid" alt="">
                </a>
                <div class="text py-4">
                  <div class="meta">
                    <div><a href="#">July 29, 2018</a></div>
                    <div><a href="#">Admin</a></div>
                  </div>
                  <h3 class="heading"><a href="#">Life looks happier</a></h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="blog-entry ftco-animate">
                <a href="blog-single.html" class="blog-image">
                	<img src="images/image_7.jpg" class="img-fluid" alt="">
                </a>
                <div class="text py-4">
                  <div class="meta">
                    <div><a href="#">July 29, 2018</a></div>
                    <div><a href="#">Admin</a></div>
                  </div>
                  <h3 class="heading"><a href="#">Life looks happier</a></h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="blog-entry ftco-animate">
                <a href="blog-single.html" class="blog-image">
                	<img src="images/image_8.jpg" class="img-fluid" alt="">
                </a>
                <div class="text py-4">
                  <div class="meta">
                    <div><a href="#">July 29, 2018</a></div>
                    <div><a href="#">Admin</a></div>
                  </div>
                  <h3 class="heading"><a href="#">Life looks happier</a></h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
      			</div>
      		</div>
      		<div class="row mt-5">
	          <div class="col text-center">
	            <div class="block-27">
	              <ul>
	                <li><a href="#">&lt;</a></li>
	                <li class="active"><span>1</span></li>
	                <li><a href="#">2</a></li>
	                <li><a href="#">3</a></li>
	                <li><a href="#">4</a></li>
	                <li><a href="#">5</a></li>
	                <li><a href="#">&gt;</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
      	</div><!-- end: page-container-->
      </section>
    	
		  <!-- loader -->
		  <div id="ftco-loader" class="show fullscreen">
		  	<svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg>
		  </div>

  	</div>


  <script src="libro/js/jquery.min.js"></script>
  <script src="libro/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="libro/js/popper.min.js"></script>
  <script src="libro/js/bootstrap.min.js"></script>
  <script src="libro/js/jquery.easing.1.3.js"></script>
  <script src="libro/js/jquery.waypoints.min.js"></script>
  <script src="libro/js/jquery.stellar.min.js"></script>
  <script src="libro/js/owl.carousel.min.js"></script>
  <script src="libro/js/jquery.magnific-popup.min.js"></script>
  <script src="libro/js/aos.js"></script>
  <script src="libro/js/jquery.animateNumber.min.js"></script>
  <script src="libro/js/scrollax.min.js"></script>
  <script src="libro/js/bootstrap-datepicker.js"></script>
  <script src="libro/js/jquery.timepicker.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="libro/js/google-map.js"></script>
  <script src="libro/js/main.js"></script>
    
  </body>
</html>