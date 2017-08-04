<?php
header("Access-Control-Allow-Origin: *");
if(isset($_GET["on"])){
    file_put_contents('alarm_state.txt', "on");
    exit('Alarme activée');
}else{
    if(isset($_GET["p"])){
        if($_GET["p"] == "2001-house-psswd"){
            file_put_contents('alarm_state.txt', "off");
        }
    }else{
        if(is_file("passwords/" . $_POST["username"] . ".php")){
            include "passwords/" . $_POST["username"] . ".php";

            if(password_verify($_POST["password"], $password)){
                file_put_contents('alarm_state.txt', "off");
                
                exit('ok');
            }else{
                exit('Erreur : mot de passe incorrect');
            }
        }else{
            exit('Erreur : cet utilisateur n\'existe pas');
        }
    }
}
?>