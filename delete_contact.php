<?php
/**
 * Created by PhpStorm.
 * User: tejsubedi
 * Date: 2017-12-07
 * Time: 2:40 PM
 */

//Delete code goes here.
include_once ("includes/global_variables.php");
include_once ("includes/functions.php");

if(isset($_GET['id']) && $_GET['id']>0){
    deleteUser($_GET['id']);
    header('location:index.php');
}