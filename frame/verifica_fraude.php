<?php
if(!$_SESSION['nome']){
    header('location: ../index.php');
    exit();
}