<?php

session_start();

if(isset($_SESSION['conference']) && !empty($_SESSION['conference'])) {
    echo json_encode(array("status"=>true));
} else {
    echo json_encode(array("status"=>false));
}