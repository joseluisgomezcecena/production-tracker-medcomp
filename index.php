<?php
//app settings (redirects, $page variable, timezone and database).
require_once("config/settings.php");

require_once("classes/Login.php");

require_once ("functions/line_config.php");

$login = new Login();


if ($login->isUserLoggedIn() == true)
{

    switch ($page)
    {
        case "line_config":
            include("views/pages/line_config/index.php");
            break;

        case "custom_report":
            include ("views/pages/reports/custom_report.php");
            break;

        default:
            include("views/pages/home/index.php");
            break;

    }


}
else
{
    switch ($page)
    {
        case "line_config":
            include("views/pages/line_config/index.php");
            break;

        default:
            include("views/pages/auth/login.php");
            break;

    }
}
