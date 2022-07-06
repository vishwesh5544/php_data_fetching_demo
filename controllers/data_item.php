<?php

class DataItem
{
    protected mixed $applicableAt;
    protected mixed $applicableFor;
    protected mixed $dataItem;
    protected mixed $value;
    protected mixed $generatedTime;

    public function __construct($applicableAt, $applicableFor, $dataItem, $value, $generatedTime) {
        $this->applicableAt = $applicableAt;
        $this->applicableFor = $applicableFor;
        $this->dataItem = $dataItem;
        $this->value = $value;
        $this->generatedTime = $generatedTime;
    }

    /**
     * @return mixed
     */
    public function getApplicableAt(): mixed
    {
        return $this->applicableAt;
    }

    /**
     * @return mixed
     */
    public function getApplicableFor(): mixed
    {
        return $this->applicableFor;
    }

    /**
     * @return mixed
     */
    public function getDataItem(): mixed
    {
        return $this->dataItem;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getGeneratedTime(): mixed
    {
        return $this->generatedTime;
    }

}