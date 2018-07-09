<?php
 session_start();
 require_once('../db.php');
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 require_once('../../PHPExcel.php');
 try{
     if(isset($_POST['download_marks'])){

     

     $sql = 'SELECT name, student_number, reg_number, marks FROM student WHERE school_id = :school_id AND course_id = :course_id';
     $stmt = $db->prepare($sql);
     $stmt->bindParam("course_id", $_SESSION['admin']['course_id']);
     $stmt->bindParam("school_id", $_SESSION['admin']['school_id']);
     $stmt->execute();
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //  create a php excel object
        $sheet = new PHPExcel();

        //  set metadata
        $sheet->getProperties()->setCreator("Mak intern system")
              ->setLastModifiedBy("Mak intern system")
              ->setTitle("Students Internship Marks")
              ->setKeyWords("students internship marks");
        
        // set default styles
        $sheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getDefaultStyle()->getFont()->setName("Lucida Sans Unicode");
        $sheet->getDefaultStyle()->getFont()->setSize(12);

        // get a reference to the active sheet
        $sheet->setActiveSheetIndex(0);
        $activeSheet = $sheet->getActiveSheet();

// set print options
        $activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT)
                                    ->setFitToWidth(1)
                                    ->setFitToHeight(0);
        $activeSheet->getHeaderFooter()->setOddHeader('&C&B&16' . 
        $sheet->getProperties()->getTitle())
              ->setOddFooter('&CPage &P of &N');

    //    populate with data
        $col_headers = array_keys($row);
        $col = 'A';
        $rownum = 1;

    // set column headings
       foreach($col_headers as $col_header){
           $activeSheet->setCellValue($col . $rownum, ucwords($col_header));
           $activeSheet->getStyle($col . $rownum)->getFont()->setBold(true);
           $activeSheet->getColumnDimension($col)->setAutoSize(true);
           $col++;
       }
     
    // populate individual cells with data
    do{
       $col = 'A';
       $rownum++;

       foreach($row as $data){
           $activeSheet->setCellValue($col++ . $rownum, $data);
       }
    }while($row = $stmt->fetch(PDO::FETCH_ASSOC));

    // give a title to the active sheet
    $activeSheet->setTitle('Marks');

    // generate and download excel spreadsheet
    

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="marks.xlsx"');
        header('Cache-Control: max-age=0');
        
		$writer = PHPExcel_IOFactory::createWriter($sheet, 'Excel2007');
		$writer->save('php://output');
		exit;
   
    }
    
 }catch(Exception $e){
     $error = $e->getMessage();
 }