<?php
    session_start();
    $_SESSION['data_user'] = session_destroy();
    header('location:login.php');