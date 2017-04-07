<?php

function formVal($fieldName, $default){
    //check for a value in $_POST, then $_GET
    //if not in POST or GET, use the default
    if(isset($_POST[$fieldName])){
        $value = $_POST[$fieldName];
        
    }else if(isset($_GET['$fieldName'])){
        $value = $_GET[$fieldName];
        
    }else{
        $value=$default;
        
    }
    //returns this value to the line of code that called the function
    return $value;
    
    //nothing runs after a return statement
}

