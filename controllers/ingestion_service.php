<?php
require_once('data_item.php');

interface IngestionService
{
    public function getTableData(): array;
}

class IngestionServiceImpl implements IngestionService
{
    private string $currentDatetime;
    private DOMNodeList $dataTableBodyDOMElement;

    public function __construct()
    {
        $date = new DateTime();
        $this->currentDatetime = $date->format('d-m-Y H:i:s');

        $rawResponse = $this->getHtmlUsingCurl();

        if ($rawResponse) {
            $this->dataTableBodyDOMElement = $this->cleanHtml($rawResponse);
        }
    }

    public function getTableData(): array
    {
        return $this->processTableDataToArray($this->dataTableBodyDOMElement);
    }

    private function processTableDataToArray(DOMNodeList $tableElement): array
    {
        $dataArray = array();
        foreach ($tableElement as $row) {
            $cells = $row->getElementsByTagName('td');
            $dataItem = new DataItem($cells->item(0)->textContent, $cells->item(1)->textContent, $cells->item(2)->textContent, $cells->item(3)->textContent, $cells->item(4)->textContent);
            $dataArray[] = $dataItem;
        }
        return $dataArray;
    }

    private function cleanHtml(string $rawHtmlEntry): DOMNodeList
    {
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($rawHtmlEntry);
        $thead = $doc->getElementsByTagName('thead');
        foreach (iterator_to_array($thead) as $item) {
            $item->parentNode->removeChild($item);
        }
        return $doc->getElementsByTagName('tr');
    }

    private function getHtmlUsingCurl(): bool|string
    {

        $publicationObjectIds = '408:28,+408:5328,+408:5320,+408:5291,+408:5366,+408:5312,+408:5346,+408:5324,+408:5316,+408:5308,+408:5336,+408:5333,+408:5342,+408:5354,+408:82,+408:70,+408:59,+408:38,+408:49';
        $publicationObjectStagingIds = 'PUBOBJ1660,PUBOB4507,PUBOB4508,PUBOB4510,PUBOB4509,PUBOB4511,PUBOB4512,PUBOB4513,PUBOB4514,PUBOB4515,PUBOB4516,PUBOB4517,PUBOB4518,PUBOB4519,PUBOB4521,PUBOB4520,PUBOB4522,PUBOBJ1661,PUBOBJ1662';
        $applicable = '';
        $publicationObjectCount = '19';
        $fromUtcDateTime = '2022-01-01T00:00:00.000Z';
        $fileType = '';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://mip-prd-web.azurewebsites.net/DataItemViewer/ViewReportDataItem',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('PublicationObjectIds' => $publicationObjectIds,
                'PublicationObjectStagingIds' => $publicationObjectStagingIds,
                'Applicable' => $applicable, 'PublicationObjectCount' => $publicationObjectCount,
                'FromUtcDateTime' => $fromUtcDateTime,
                'ToUtcDateTime' => $this->currentDatetime,
                'FileType' => $fileType),
        ));

        return curl_exec($curl);
    }

}