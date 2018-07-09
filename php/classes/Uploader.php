<?php
class Uploader{
    public static $errors = [];

    public static function upload($file, $max_size){
        $allowed = ['xlsx'];
        $file_name = $file['name'];
        $tmp_name = $file['tmp_name'];
        $file_type = $file['type'];
        $file_error = $file['error'];
        $file_size = $file['size'];
        
        $extension = explode('.', $file_name);
        $ext = strtolower(end($extension));
                
        if($file_size < $max_size){
            if(in_array($ext, $allowed)){
                if($file_error === 0){
                    $file_new_name = 'excel'.'.'.$ext ;
                    $file_destination = DESTINATION.'\\'.$file_new_name;
                    $move_file = move_uploaded_file($tmp_name, $file_destination);
                    if($move_file){
                        return $file_destination;
                    }else{
                        return false;
                    }
                }else{
                    switch ($file_error) {
                        case 1:
                            self::$errors[] = "$file_name exceeds server limit for size of individual files.";
                            break;
                        case 4:
                            self::$errors[] = 'No file selected.';
                            break;
                        default:
                            self::$errors[] = "Error Uploading $file_name.";
                    }
                    return false;
                }
            }else{
                self::$errors[] = "The file type of $file_name is not allowed";
                return false;
            }
        }else{
            self::$errors[] = "The file size of $file_name is too large";
            return false;
        }
   
    }

    public static function getErrors(){
        return self::$errors;
    }
}