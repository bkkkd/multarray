<?php
/**
 * Short description for multarray.php
 *
 * @package multarray
 * @author tim <tim@tim-PC>
 * @version 0.1
 * @copyright (C) 2018 tim <tim@tim-PC>
 * @license MIT
 */

namespace MultArray;

class MultArray{
    public function __construct(){
    }
    public function toCsv($rows){
        $data = [];
        foreach($rows as $row){
            $ra = new RowArray($row);
            $data[] = $ra->getKvArray();
        }
        return Csv::array_to_csv($data);
    }
    public function fromCsv($file, $offset_line=0, $read_line=0, $read_max_length=0){
        $data = Csv::csv_to_array($file, $offset_line, $read_line, $read_max_length);
        $render = [];
        foreach($data['data'] as $row){
            $ra = new RowArray($row);
            $render[] = $ra->getMultArray();
        }

        return $render;
    }

}
