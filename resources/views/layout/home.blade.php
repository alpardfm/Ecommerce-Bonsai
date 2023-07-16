<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bonsai Shop</title>

  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">

  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.client_key')}}"></script>
  <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,400i,600,700' rel='stylesheet'>

  <!-- Css -->
  <link rel="stylesheet" href="/front/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/front/css/magnific-popup.css" />
  <link rel="stylesheet" href="/front/css/font-icons.css" />
  <link rel="stylesheet" href="/front/css/sliders.css" />
  <link rel="stylesheet" href="/front/css/style.css" />

  <!-- Favicons -->
  <link rel="shortcut icon" href="/front/img/favicon.ico">
  <link rel="apple-touch-icon" href="/front/img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/front/img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/front/img/apple-touch-icon-114x114.png">
  <link rel="stylesheet" href="/assets/output.css">

</head>

<body>

  <!-- Preloader -->
  <div class="loader-mask">
    <div class="loader">
      <div></div>
      <div></div>
    </div>
  </div>

  <main class="main-wrapper">

    <header class="nav-type-1">

      <!-- Fullscreen search -->
      <div class="search-wrap">
        <div class="search-inner">
          <div class="search-cell">
            <form method="get">
              <div class="search-field-holder">
                <input type="search" class="form-control main-search-input" placeholder="Search for">
                <i class="ui-close search-close" id="search-close"></i>
              </div>
            </form>
          </div>
        </div>
      </div> <!-- end fullscreen search -->



      <nav class="navbar navbar-static-top">
        <div class="navigation" id="sticky-nav">
          <div class="container relative">

            <div class="row flex-parent">

              <div class="navbar-header flex-child">
                <!-- Logo -->
                <div class="logo-container">
                  <div class="logo-wrap">
                    <a href="/">
                      <img class="logo-dark2" src="/img/logo.jpg" alt="logo" width="50" height="50">
                    </a>
                  </div>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <!-- Mobile cart -->
                <div class="nav-cart mobile-cart hidden-lg hidden-md">
                  <div class="nav-cart-outer">
                    <div class="nav-cart-inner">
                      <a href="/cart" class="nav-cart-icon">
                      </a>
                    </div>
                  </div>
                </div>
              </div> <!-- end navbar-header -->

              <div class="flex-child flex-right nav-right hidden-sm hidden-xs">
                <ul>
                  @if(!Auth::check())
                  <li class="nav-login">
                    <a href="/login_member">Login</a>
                  </li>
                  <li class="nav-login">
                    <a href="register_member">Register</a>
                  </li>
                  @else

                  <li class="nav-cart">
                    <div class="nav-cart-outer">
                      <div class="nav-cart-inner">
                        <a href="/cart">
                          <i class="fa fa-shopping-cart" style="font-size:30px" title="Keranjang"></i>
                        </a>
                      </div>
                    </div>
                  </li>

                  <li class="nav-cart">
                    <div class="nav-cart-outer">
                      <div class="nav-cart-inner">
                        <a href="/history">
                          <i class="fa fa-history" style="font-size:30px" title="History Transaksi"></i>
                        </a>
                      </div>
                    </div>
                  </li>

                  <li class="nav-cart">
                    <div class="nav-cart-outer">
                      <div class="nav-cart-inner">
                        <a href="#">
                          <i class="fa fa-user" style="font-size:30px"></i>
                        </a>
                      </div>
                    </div>
                    <div class="nav-cart-container">
                      <div class="nav-cart-items">
                        <div class="nav-cart-actions mt-20">
                          <a href="/logout_member" class="btn btn-md btn-dark"><span>Logout</span></a>
                        </div>
                      </div>
                    </div>
                  </li>
                  @endif
                </ul>
              </div>

            </div> <!-- end row -->
          </div> <!-- end container -->
        </div> <!-- end navigation -->
      </nav> <!-- end navbar -->
    </header>

    @yield('content')

    <!-- Footer Type-1 -->
    <footer class="footer footer-type-1">
      <div class="bottom-footer">
        <div class="container">
          <div class="row">

            <div class="col-sm-6 copyright sm-text-center">
              <span>
                &copy; 2023 Bonsai Shop</a>
              </span>
            </div>

            <div class="col-sm-6 col-xs-12 footer-payment-systems text-right sm-text-center mt-sml-10">
              <i class="fa fa-cc-paypal"></i>
              <i class="fa fa-cc-visa"></i>
              <i class="fa fa-cc-mastercard"></i>
              <i class="fa fa-cc-discover"></i>
              <i class="fa fa-cc-amex"></i>
            </div>

          </div>
        </div>
      </div> <!-- end bottom footer -->
    </footer> <!-- end footer -->

    <div id="back-to-top">
      <a href="#top"><i class="fa fa-angle-up"></i></a>
    </div>

    </div> <!-- end content wrapper -->
  </main> <!-- end main wrapper -->

  <!-- jQuery Scripts -->
  <script type="text/javascript" src="/front/js/jquery.min.js"></script>
  <script type="text/javascript" src="/front/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/front/js/plugins.js"></script>
  <script type="text/javascript" src="/front/js/scripts.js"></script>

  @stack('js')

</body>

</html>