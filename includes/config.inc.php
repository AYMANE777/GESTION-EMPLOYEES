<?php
define("SITE_NAME", "OfficeParrain");
define("DB_HOST", "localhost");
define("DB_NAME", "parrainage");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

$connect = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
?>