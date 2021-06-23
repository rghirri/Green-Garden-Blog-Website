<?php

$db_host = "localhost";
$db_name = "green_garden_blog_db";
$db_user ="ggb_cms";
$db_pass ="rjQ2BtgiCz246XDe";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

echo "Connected successfully";

?>