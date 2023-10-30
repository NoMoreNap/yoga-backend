<?php

class MySQL {
    public function __construct($host, $user, $pass, $db){
        $ms = mysqli_connect($host, $user, $pass, $db);
        {
             if(!$ms){
                 return false;
             }
             $this->ms = $ms;
             return $ms;
        }
    }

    public function __destruct () {
        $this->ms->close();
    }

    public function query($query) {
        return mysqli_query ($this->ms, $query);
    }

    public function insert($table, $fields, $values) {
        $sql_values = '';
        foreach ($values as $value) {
            $sql_values .= "'$value',";
        }
        if (mb_substr($sql_values,-1) == ',') {
            $sql_values = mb_substr($sql_values, 0, -1);
        }
        $query = "INSERT INTO $table($fields) VALUES ($sql_values)";
        return $this->query($query);
    }

    public function select($table,$fields, $condition = 1) {
        $query = "SELECT $fields from $table WHERE $condition";
        return mysqli_fetch_all($this->query($query),1);
    }
}
