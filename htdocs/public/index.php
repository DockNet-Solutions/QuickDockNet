<html>
    <head>

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