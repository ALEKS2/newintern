<?php
require_once('../../PHPExcel.php');
try{
    function exceler($file){
        $studentArray = [];
       
        // create an excel data object
        $objReader = new PHPExcel_Reader_Excel2007();
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        $active = $objPHPExcel->getActiveSheet();
    //  get the highest row and column name
        $highestRow = $active->getHighestRow();
        $highetColumn = $active->getHighestColumn();
//   get the numeric representation of the highest column name
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highetColumn);

        /* loop through the rows and columns to get the data
        for each cell and store it in the respective array */
        for($rows = 2; $rows <= $highestRow; $rows++){
            for($cols = 0; $cols < $highestColumnIndex; $cols++){
                $studentArray[$active->getCellByColumnAndRow($cols, 1)->getValue()] = $active->getCellByColumnAndRow($cols, $rows)->getValue();
            }
            $studentsArray[] = $studentArray;

            // empty the studentArray after adding its data into the studentsArray
            $studentArray = [];
        }
        return $studentsArray;
    }
}catch(Exception $e){
    $error = $e->getMessage();
    
}