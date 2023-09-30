<?php

require_once ('BoxInterface.php');

abstract class AbstractBox implements BoxInterface
{
    protected array $data = [];
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getData($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    abstract public function save();
    abstract public function load();
}