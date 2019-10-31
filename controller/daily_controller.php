<?php

require_once("model/daily_model.php");

$model = new daily_model();
$datos = $model->get_feed();

require_once("view/daily_view.phtml");

?>