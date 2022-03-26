<?php


require __DIR__ . "/inc/bootstrap.php";


echo "test";
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = explode("/", $uri);

// if in subdirectory, shift uri, moving it to util
Util::shift_to_index($uri);


if (isset($uri[1]) && $uri[1] != "user" || !isset($uri[2])) {
    header("HTTP/1.1 404 Not found");
    exit();
}

require PROJECTROOT . "./controller/api/user.php";

$objfeedcontroller = new UserController();

$strMethodName = $uri[2]. "Action";
echo "dbg0";
$objfeedcontroller->{$strMethodName}();

