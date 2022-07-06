<?php

require_once('db.php');
require_once ('data_provider.php');

ob_start();
$dataProvider = new DataProviderImpl();
ob_end_clean();
print_r(json_encode($dataProvider->getData()));





