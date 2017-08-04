<?php
header("Access-Control-Allow-Origin: *");
exit(file_get_contents('alarm_state.txt'));
?>