<?php

require_once ('AbstractBox.php');
class DbBox extends AbstractBox
{
    private static $_instance;

    private $connection;

    private function __construct($connection) {
        $this->connection = $connection;
    }

    private function __clone() {}

    public static function getInstance($connection) {
        if (self::$_instance === null) {
            self::$_instance = new self($connection);
        }

        return self::$_instance;
    }

    public function save()
    {
        if (!empty($this->data)){
            $sql = "INSERT INTO DbBox (`key`, `value`) VALUES ";
            $size = count($this->data);
            foreach ($this->data as $key=>$value ) {
                $sql .= "('{$key}', '{$value}')";
                if  ($size > 1) {
                    $sql .= ", ";
                }
                $size -=1;
            }

            $sql .= " ON DUPLICATE KEY UPDATE `key`=VALUES(`key`),`value`=VALUES(`value`)";

            print_r($sql);
            mysqli_query($this->connection, $sql);
        }
    }

    public function load()
    {
        $sql = "SELECT * FROM DbBox";

        $db_data = mysqli_query($this->connection, $sql);

        if (!empty($db_data)){
            while ($row = mysqli_fetch_assoc($db_data)) {
                $this->data[$row["key"]] = $row["value"];
            }
        }
    }
}