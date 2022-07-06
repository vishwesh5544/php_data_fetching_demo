<?php
require_once('db.php');
require_once('ingestion_service.php');

interface DataProvider
{
    public function getData(): array;
}

class DataProviderImpl implements DataProvider
{

    private array $ingestedTableData;
    private mysqli $dbConnection;
    private array $dataItems;

    public function __construct()
    {
        $db = new Db('scraping_demo');
        $this->dbConnection = $db->connection;
        $ingestionService = new IngestionServiceImpl();
        $this->ingestedTableData = $ingestionService->getTableData();
        $this->deleteOldData();
        $this->insertDataToDb();
        $this->dataItems = $this->fetchDataFromDb();

    }

    private function deleteOldData(): void
    {
        $this->dbConnection->query("TRUNCATE data");
    }

    private function fetchDataFromDb(): array
    {
        $statement = $this->dbConnection->query("SELECT * FROM data");
        return $statement->fetch_all(1);
    }

    public function getData(): array
    {
        return $this->dataItems;
    }

    private function insertDataToDb(): void
    {
        $db = new Db('scraping_demo');
        $dbConn = $db->connection;
        foreach ($this->ingestedTableData as $ingestedTableDatum) {
            $queryString = "INSERT INTO data(applicable_at, applicable_for, data_item, value, generated_time) VALUES(?,?,?,?,?)";
            $statement = $this->dbConnection->prepare($queryString);
            $applicableAt = $ingestedTableDatum->getApplicableAt();
            $applicableFor = $ingestedTableDatum->getApplicableFor();
            $dataItem = $ingestedTableDatum->getDataItem();
            $value = $ingestedTableDatum->getValue();
            $generatedTime = $ingestedTableDatum->getGeneratedTime();
            $statement->bind_param("sssss", $applicableAt, $applicableFor, $dataItem, $value, $generatedTime);
            $statement->execute();
        }

    }


}