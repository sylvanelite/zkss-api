<?php
define("HOST", getenv('OPENSHIFT_MYSQL_DB_HOST'));
define("PORT", getenv('OPENSHIFT_MYSQL_DB_PORT'));
define("USER", getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define("PASSWORD", getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
define("DATABASE", "zkss");
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>