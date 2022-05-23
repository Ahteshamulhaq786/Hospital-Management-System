<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="index, follow">
    <meta name="description" content="Bayanno Hospital Management System">
    <meta name="keywords" content="bootstrap, responsive, template, website, html, theme, ux, ui, web, design, developer, support, business, corporate, real estate, education, medical, school, education, demo, css, framework">
    <meta name="author" content="Creativeitem">
    <title>Home | Clinic Automation System</title>
    

    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/pace-minimal.css')?>" type="text/css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/bootstrap.min.css')?>" type="text/css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Plugins -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/swiper.min.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/hamburgers.min.css')?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/animate.min.css')?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/iziToast.min.css')?>" type="text/css">
    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/ionicons.min.css')?>" type="text/css">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/line-icons-pro.css')?>" type="text/css">
    
    <link rel="stylesheet" href="<?= base_url('assets/frontend/Css/font-awesome.min.css')?>" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



    <!-- Global style (main) -->
    <link id="stylesheet" type="text/css" href="<?= base_url('assets/frontend/Css/global-style.css')?>" rel="stylesheet" media="screen">

    <!-- Custom style - Remove if not necessary -->
    <link type="text/css" href="<?= base_url('assets/frontend/Css/custom-style.css')?>" rel="stylesheet">
    <!-- Favicon -->
    <link href="<?=base_url('assets/frontend/images/Mylogo2.PNG'); ?>" rel="icon" type="image/png">

    @provide(links)
</head>

<body>
    <!-- MAIN WRAPPER -->
    <div class="body-wrap">
        <div id="st-container" class="st-container">
            <div id="doctor_details">
                <!-- response -->
            </div>
            <div class="st-pusher">
                <div class="st-content">
                    <div class="st-content-inner">
                        <!-- Navbar -->
                        <nav class="navbar navbar-expand-lg  navbar-light bg-default navbar--link-arrow navbar--uppercase bayanno-nav">
                            <div class="container navbar-container">
                                <!-- Brand/Logo -->
                                <a class="navbar-brand" href="<?=base_url('index.php'); ?>">
                                    <img src="<?=base_url('assets/frontend/images/Mylogo2.PNG'); ?>" width="40" alt="">
                                    &nbsp; Clinic Automation System </a>

                                <div class="d-inline-block">
                                    <!-- Navbar toggler  -->
                                    <button class="navbar-toggler hamburger hamburger-js hamburger--spring" type="button" data-toggle="collapse" data-target="#navbar_main" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="hamburger-box">
                                            <span class="hamburger-inner"></span>
                                        </span>
                                    </button>
                                </div>

                                <div class="collapse navbar-collapse align-items-center justify-content-end" id="navbar_main">

                                    <!-- Navbar links -->
                                    <ul class="navbar-nav" data-hover="dropdown">
                                        <li class="nav-item active">
                                            <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="<?=base_url('index.php'); ?>">
                                                Home</a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="<?=base_url('index.php/Home/department')?>" class="nav-link" aria-haspopup="true" aria-expanded="false">
                                                Departments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="<?=base_url('index.php/Home/doctors')?>">
                                                Doctors</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="<?=base_url('index.php/Home/about')?>">
                                                About </a>
                                        </li>
                                        <?php if (!$this->session->has_userdata('IDENTITY_WHO_LOGINS') && !$this->session->has_userdata('LOGGED_IN')) : ?>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="<?=base_url('index.php/Home/register_patient')?>">
                                                Register </a>
                                           <?php endif; ?>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="<?=base_url('index.php/Home/contact')?>">
                                                Contact </a>
                                        </li>
                                        <?php if(!$this->session->has_userdata('IDENTITY_WHO_LOGINS') && !$this->session->has_userdata('LOGGED_IN')) : ?>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="<?=base_url('index.php/Home/login')?>" target="_blank">
                                                Login </a>
                                        </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            </div>
                        </nav>
                        @provide(content)

                                                <!-- FOOTER -->
                        <footer id="footer" class="footer">
                            <div class="footer-top">
                                <div class="container">
                                    <div class="row cols-xs-space cols-sm-space cols-md-space">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="col text-center">
                                                <img src="<?=base_url('assets/frontend/images/Mylogo3.PNG'); ?>" width="60" alt="">
                                                &nbsp; <p class="mt-3">Clinic Automation System</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="col">
                                                <h4 class="heading heading-xs strong-600 text-uppercase mb-1">
                                                    Main Menu </h4>

                                                <ul class="footer-links">
                                                    <li>
                                                        <a href="<?=base_url('index.php'); ?>">
                                                            Home </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?=base_url('index.php/Home/doctors')?>">
                                                            Doctors </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?=base_url('index.php/Home/make_appointment')?>">
                                                            Make An Appointment </a>
                                                    </li>
                                                    <?php if(!$this->session->has_userdata('IDENTITY_WHO_LOGINS') && !$this->session->has_userdata('LOGGED_IN')) : ?>
                                                    <li>
                                                        <a href="<?=base_url('index.php/Home/login')?>" target="_blank">
                                                            Login </a>
                                                    </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="col">
                                                <h4 class="heading heading-xs strong-600 text-uppercase mb-1">
                                                    Help And Support </h4>

                                                <ul class="footer-links">
                                                    <li>
                                                        <a href="<?=base_url('index.php/Home/contact')?>">
                                                            Contact Us </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?=base_url('index.php/Home/about')?>">
                                                            About Us </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="footer-bottom">
                                <div class="container">
                                    <div class="row row-cols-xs-spaced flex flex-items-xs-middle">
                                        <div class="col col-sm-7 col-xs-12">
                                            <div class="copyright text-xs-center text-sm-left">
                                               Copyright &copy; | 2021 </div>
                                        </div>

                                        <div class="col col-sm-5 col-xs-12">
                                            <div class="text-xs-center text-sm-right">
                                                <ul class="social-media social-media--style-1-v4">
                                                    <li>
                                                        <a href="http://facebook.com" target="_blank">
                                                            <i class="ion ion-social-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://twitter.com" target="_blank">
                                                            <i class="ion ion-social-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://google.com" target="_blank">
                                                            <i class="ion ion-social-googleplus"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://youtube.com" target="_blank">
                                                            <i class="ion ion-social-youtube"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div><!-- END: st-pusher -->
        </div><!-- END: st-container -->
    </div><!-- END: body-wrap -->





    <script src="<?= base_url('doctor_assets/js/jquery-3.1.1.min.js') ?>"></script>

    <!--jquery-->
    <script src="<?=base_url('assets/offline-links/frontend/jquery.min.js')?>"></script>

    <!-- Page loader -->
    <script src="<?=base_url('assets/offline-links/frontend/pace.min.js')?>"></script>
    <a href="#" class="back-to-top btn-back-to-top">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </a>

    <!-- Core -->
    <script src="<?=base_url('assets/offline-links/frontend/popper.min.js')?>"></script>
    <script src="<?=base_url('assets/offline-links/frontend/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/offline-links/frontend/jquery.easing.js')?>"></script>
    <script src="<?=base_url('assets/offline-links/frontend/ie10-viewport-bug-workaround.js')?>"></script>
    <script type="text/javascript">
 var SidebarMenuEffects = (function() {

    function hasParentClass( e, classname ) {
        if(e === document) return false;
        if( classie.has( e, classname ) ) {
            return true;
        }
        return e.parentNode && hasParentClass( e.parentNode, classname );
    }
    function mobilecheck() {
        var check = false;
        (function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    }

    function init() {

        var container = document.getElementById( 'st-container' ),
            buttons = Array.prototype.slice.call( document.querySelectorAll( '.btn-st-trigger' ) ),
            // event type (if mobile use touch events)
            eventtype = mobilecheck() ? 'touchstart' : 'click',
            resetMenu = function() {
                classie.remove( container, 'st-menu-open' );
            },
            bodyClickFn = function(evt) {
                if( !hasParentClass( evt.target, 'st-menu' ) ) {
                    resetMenu();
                    document.removeEventListener( eventtype, bodyClickFn );
                }
            };

        buttons.forEach( function( el, i ) {
            var effect = el.getAttribute('data-effect');
            var url = el.getAttribute('id');

            // console.log(url);

            el.addEventListener( eventtype, function( ev ) {
                ev.stopPropagation();
                ev.preventDefault();
                container.className = 'st-container'; // clear
                classie.add( container, effect );
                $.ajax({
                    url: url,
                    success: function(response) {
                        jQuery('#doctor_details').html(response);
                        setTimeout( function() {
                            classie.add( container, 'st-menu-open' );
                        }, 25 );
                        document.addEventListener( eventtype, bodyClickFn );
                    }
                });
            });
        } );

    }

    init();

})();
    </script>
    <script src="<?= base_url('assets/frontend/Js/classie.js')?>"></script>

    <!-- Bootstrap Extensions -->
    <script src="<?= base_url('assets/frontend/Js/bootstrap-dropdown-hover.js')?>"></script>

    <!-- Plugins -->
    <script src="<?= base_url('assets/frontend/Js/flatpickr.min.js')?>"></script>
    <script src="<?= base_url('assets/frontend/Js/swiper.min.js')?>"></script>
    <script src="<?= base_url('assets/frontend/Js/iziToast.min.js')?>"></script>

    <!-- App JS -->
    <script src="<?= base_url('assets/frontend/Js/wpx.app.js')?>"></script>

    @provide(scripts)
</body>

</html>