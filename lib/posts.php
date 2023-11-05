<?php
require_once 'mysql.php';

class Posts extends MySQL

{
    public function getGeneralData () {
        return $this->select('posts','id, title');
    }
    public function dataParse($parseData) {
        foreach ($parseData as $index => $data) {
            $parseData[$index]['description'] = explode("###",$data['description']);
            $parseData[$index]['similarity'] = explode("###",$data['similarity']);
            $parseData[$index]['directions'] = explode("###",$data['directions']);
            foreach ($parseData[$index]['description'] as $i => $sub_data) {
                if (strpos($sub_data,'*') !== false) {
                    $sub_data = explode('*', $sub_data);
                    $sub_description = array('title' => $sub_data[0], 'under' => array_slice($sub_data,1));
                    $parseData[$index]['description'][$i] = $sub_description;
                }
            }
        }
        return $parseData;
    }
    public function getAllData () {
        $allData =  $this->select('posts','*');
        $allData = $this->dataParse($allData);
        return $allData;
    }
    public function getById ($id) {
        $data = $this->select('posts','*', "id = $id");
        if (count($data)) {
            $data = $this->dataParse($data);
            return $data;
        } else {
            return false;
        }

    }
}
