<?php
/*if(file_get_contents('alarm_state') == "on"){
    echo "the alarm state is : on";
}*/

if (isset($_GET["ajax"])){

    try{
        exit(file_get_contents("cam" . $_GET["id"]));
    }catch(Exception $e){
        exit($e);
    }

}else{

    include "gui.php";

}
?>