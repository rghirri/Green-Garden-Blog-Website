<?php

/**
 * Get the database connection
 *
 * @return object Connection to a MySQL server
 */
function getDB()
{
$db_host = "localhost";
$db_name = "green_garden_blog_db";
$db_user ="ggb_cms";
$db_pass ="rjQ2BtgiCz246XDe";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

return $conn;
}