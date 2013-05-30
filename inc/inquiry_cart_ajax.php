<?php

session_start();

unset($_SESSION[$_SESSION['sid']][$_POST['id']]);
$_SESSION['total']--;