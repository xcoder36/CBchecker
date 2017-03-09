<?php
require_once ('Controller.php');

// fait le lien entre le controller et l'interface
 Controller::checkCB($_POST['number'], $_POST['CVV'],$_POST['Month'], $_POST['Year'],$_POST['price'])


?>