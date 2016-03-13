<?php
session_start();

unset($_SESSION['uid']);

$goback = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
header("Location: $goback");