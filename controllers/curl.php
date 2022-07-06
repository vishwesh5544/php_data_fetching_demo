<?php

ob_start();
$curl = curl_init();

$publicationObjectIds = '408:28,+408:5328,+408:5320,+408:5291,+408:5366,+408:5312,+408:5346,+408:5324,+408:5316,+408:5308,+408:5336,+408:5333,+408:5342,+408:5354,+408:82,+408:70,+408:59,+408:38,+408:49';
$publicationObjectStagingIds = 'PUBOBJ1660,PUBOB4507,PUBOB4508,PUBOB4510,PUBOB4509,PUBOB4511,PUBOB4512,PUBOB4513,PUBOB4514,PUBOB4515,PUBOB4516,PUBOB4517,PUBOB4518,PUBOB4519,PUBOB4521,PUBOB4520,PUBOB4522,PUBOBJ1661,PUBOBJ1662';
$applicable = '';
$publicationObjectCount = '19';
$fromUtcDateTime = '2022-01-01T00:00:00.000Z';
$toUtcDateTime = '';
$fileType = '';


curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://mip-prd-web.azurewebsites.net/DataItemViewer/ViewReportDataItem',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('PublicationObjectIds' => $publicationObjectIds, 'PublicationObjectStagingIds' => $publicationObjectStagingIds, 'Applicable' => $applicable, 'PublicationObjectCount' => $publicationObjectCount, 'FromUtcDateTime' => $fromUtcDateTime, 'ToUtcDateTime' => $toUtcDateTime, 'FileType' => $fileType),
));

$response = curl_exec($curl);

curl_close($curl);
ob_end_clean();
echo $response;