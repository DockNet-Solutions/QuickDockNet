<html>
    <head>
        <title>Login QuickDockNet</title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="public/assets/theme.css">
        <script type="module" src="public/assets/custom.js"></script>
        <script
                src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
                crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            toastr.options = {
                "closeButton"   : true,
                "debug"         : true,
                "newestOnTop"      : false,
                "progressBar"      : false,
                "positionClass"    : "toast-top-right",
                "preventDuplicates": false,
                "onclick"          : null,
                "showDuration"     : "500",
                "hideDuration"     : "500",
                "timeOut"          : "5000",
                "extendedTimeOut"  : "1000",
                "showEasing"       : "swing",
                "hideEasing"       : "linear",
                "showMethod"       : "fadeIn",
                "hideMethod"       : "fadeOut"
            }
        </script>
    </head>
    <body>
        <?php
        use modele\Mail;
        echo Mail::sendMail("Welcome guedesite to DockNet !",
            Mail::build("Welcome to DockNet !",
                "Thanks for joining us !"),
            "guedesite77@gmail.com", "guedesite");

        exit();
            if(isset($_GET["page"])) {
                switch($_GET["page"]) {
                    case 'login':
                        include("pages/login.php");
                        break;
                    case 'register':
                        include("pages/register.php");
                        break;
                    case 'accueil':
                        include("pages/accueil.php");
                        break;
                    default:
                        include("pages/404.php");
                        break;
                }
            } else {
                include("pages/login.php");
            }

        ?>
    </body>
</html>