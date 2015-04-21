<?php

namespace App;

class Collection
{
    protected $data;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Outputs data as a json.
     * @return void
     */
    public function toJson()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }
}
