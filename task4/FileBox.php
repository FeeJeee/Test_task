<?php

require_once ('AbstractBox.php');
class FileBox extends AbstractBox
{
    private static $_instance;

    private $file;

    private function __construct($file) {
        $this->file = $file;
    }

    private function __clone() {}

    public static function getInstance($file) {
        if (self::$_instance === null) {
            self::$_instance = new self($file);
        }

        return self::$_instance;
    }

    public function save()
    {
        if (!empty($this->data)){
            $file_data = json_decode(file_get_contents($this->file), true);
            if (!empty($file_data)){
                foreach ($this->data as $key=>$value) {
                    $file_data[$key] = $value;
                }
                file_put_contents($this->file, json_encode($file_data));
            } else {
                file_put_contents($this->file, json_encode($this->data));
            }
        }
    }

    public function load()
    {
        $file_data = json_decode(file_get_contents($this->file), true);

        if (!empty($file_data)){
            foreach ($file_data as $key=>$value){
                $this->data[$key] = $value;
            }
        }
    }
}