<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="theme-color" content="main">
        <meta name="msapplication-navbutton-color" content="main">
        <meta name="apple-mobile-web-app-statut-bar-style" content="main">

        <meta name="robots" content="follow, index, all">
        <meta name="google" content="notranslate">

        <link type="text/css" href="public/assets/theme.css" rel="stylesheet">
        <script type="application/javascript" src="public/assets/custom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <?php 
            if(isset($_GET["page"])) {
                switch($_GET["page"]) {
                    case 'login':
                        include("pages/login.php");
                        break;
                    case 'register':
                        include("pages/register.php");
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