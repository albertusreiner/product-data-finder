<?php
    session_start();
    session_reset();
    $_SESSION = array();
    header('location:  '.'../');


?>