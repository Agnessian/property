<?php
session_start();

    function loggedIn()
    {
        if(isset($_SESSION['userId'])){
            return true;
        }else{
            return false;
        }
    }
