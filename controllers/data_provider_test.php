<?php

require_once ('data_provider.php');

$dataProvider = new DataProviderImpl();
print_r($dataProvider->getData());