<?php


namespace app\libraries;


class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}