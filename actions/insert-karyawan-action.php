<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: login.html");
}