<!DOCTYPE html>
<html lang="en">

<head>

    <?php echo $this->getMeta(); ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">


    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/assets/css/tooplate-main.css">
    <link rel="stylesheet" href="/assets/css/owl.css">
    <link rel="stylesheet" href="/assets/css/flex-slider.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!--
    Tooplate 2114 Pixie
    https://www.tooplate.com/view/2114-pixie
    -->
</head>

<body>

    <!-- Pre Header -->
    <div id="pre-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span>Suspendisse laoreet magna vel diam lobortis imperdiet</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="<?=PATH?>"><img src="/assets/images/header-logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse container menu" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->controller === 'Main') echo 'active'; ?>" href="<?=PATH?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->controller === 'Product') echo 'active'; ?>" href="<?=PATH?>/products/view">Products</a>
                        <?php new \app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/menu.php',
                        ]); ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->controller === 'About') echo 'active'; ?>" href="about.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->controller === 'Contact') echo 'active'; ?>" href="contact.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($this->controller === 'Cart') echo 'active'; ?>" href="<?=PATH?>/cart/view">
                            Shopping cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            Log in
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (empty($_SESSION['user'])): ?>
                            <form class="px-4 py-3" method="post" action="/user/login" id="login" role="form" data-toggle="validator">
                                <div class="form-group has-feedback">
                                    <label for="inputLogin" class="control-label">Login</label>
                                    <input name="login" type="text" class="form-control" id="inputLogin"
                                           value="<?= isset($_SESSION['form_data']['login'])? $_SESSION['form_data']['login'] : '' ?>"
                                           placeholder="Login" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="inputPassword" class="control-label">Password</label>
                                    <input name="password" type="password" class="form-control" id="inputPassword"
                                           placeholder="Password" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                        Remember me
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary auth">Log in</button>
                                </div>
                            </form>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=PATH?>/user/signup">New around here? Sign up</a>
                            <a class="dropdown-item" href="#">Forgot password?</a>
                            <?php else: ?>
                            <h5 class="dropdown-header"><?=$_SESSION['user']['name']?>, successfully logged in.</h5>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=PATH?>/cart/view">Go to cart</a>
                            <a class="dropdown-item" href="<?=PATH?>/user/logout">Logout</a>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (isset($_SESSION['errors']) || isset($_SESSION['success'])): ?>
    <div class="content-errors">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['errors']; unset($_SESSION['errors']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="content">
        <?php echo $content; ?>
    </div>

    <!-- Subscribe Form Starts Here -->
    <div class="subscribe-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>Subscribe on PIXIE now!</h1>
                    </div>
                </div>
                <div class="col-md-8 offset-md-2">
                    <div class="main-content">
                        <p>Integer vel turpis ultricies, lacinia ligula id, lobortis augue. Vivamus porttitor dui id dictum efficitur. Phasellus vel interdum elit.</p>
                        <div class="container">
                            <form id="subscribe" action="" method="get">
                                <div class="row">
                                    <div class="col-md-7">
                                        <fieldset>
                                            <input name="email" type="text" class="form-control" id="email"
                                                   onfocus="if(this.value == 'Your Email...') { this.value = ''; }"
                                                   onBlur="if(this.value == '') { this.value = 'Your Email...';}"
                                                   value="Your Email..." required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-5">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="button">Subscribe Now!</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Subscribe Form Ends Here -->



    <!-- Footer Starts Here -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo">
                        <img src="/assets/images/header-logo.png" alt="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">How It Works ?</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Ends Here -->


    <!-- Sub Footer Starts Here -->
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-text">
                        <p>Copyright &copy; 2019 Company Name

                            - Design: <a rel="nofollow" href="https://www.facebook.com/tooplate">Tooplate</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sub Footer Ends Here -->


    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="/assets/js/isotope.js"></script>
    <script src="/assets/js/flex-slider.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="/assets/js/owl.js"></script>
    <script src="/assets/js/cart.js"></script>
    <script src="/assets/js/megamenu.js"></script>
    <script src="/assets/js/validator.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>


    <script language = "text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t){                   //declaring the array outside of the
            if(! cleared[t.id]){                      // function makes it static and global
                cleared[t.id] = 1;  // you could use true and false, but that's more typing
                t.value='';         // with more chance of typos
                t.style.color='#fff';
            }
        }
    </script>


</body>

</html>
