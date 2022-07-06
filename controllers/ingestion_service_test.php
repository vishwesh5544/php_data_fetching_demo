<?php

require_once('ingestion_service.php');

$ingestionService = new IngestionServiceImpl();
echo "starting service... \n";
print_r($ingestionService->getTableData());

