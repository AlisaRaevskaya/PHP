<?php
$post= $_POST;

$files=$_FILES;
var_dump($post);
var_dump($files);

$file_name = $files['pictures']['name'];
$file_size = $files['pictures']['size'];
$file_type = $files['pictures']['type'];
$file_tmp_name= $files['pictures']['tmp_name'];
$file_error= $files['pictures']['error'];
// $allowedTypes = array('image/gif', 'image/png', 'image/jpeg');
   

if(ifExists($files)){
    //если кнопка "Submit" нажата, и файл уже загружен на сервер 
        foreach($file_name as $f_name){//перебор имен
            if(checkType($file_type) && checkSize($file_size))
            {//если checkSize($array) и function checkType($array)==true
            $ext = pathinfo($f_name, PATHINFO_EXTENSION);
            $name= md5($f_name. microtime().rand(0, 999));
            $name.=".$ext";
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            checkError($file_error); //UPLOAD_ERR_OK ==true
            }else{
            echo "Файл $f_name не загружен." . checkError($file_error);//checkError($array)
            }
        }
};
   
 
// //проверка на существование формы
function ifExists($array){
    if(isset($array)) {//
        return true;       
   }else{
    echo codeToMessage(4);
    return false;
   } 
}   

function checkError($array){
    foreach($array as $key => $error){
    if ($error === 0){
        echo"Файл успешно загружен";
        return true;
        }else{
        echo codeToMessage($error);
        }
    }
}
//валидация изображения

//проверка типа//$files['pictures']['type']
function checkType($array){
    foreach($array as $key => $type){
        if(mime_content_type($type) == "image/gif"|| mime_content_type($type)=="image/jpg"||mime_content_type($type)=="image/png"){
            return true;
        }
        else{
        echo "Извините, разрешено только файлы JPG, JPEG, PNG и GIF." . codeToMessage(8);
        return false;
        }
    }
}


//проверка размера
function checkSize($array){
    foreach ($array as $key => $file_size){
        if ($file_size> 4000)
        {
        echo codeToMessage(1);
        return false;
        }
        elseif($file_size===0)
        {
        echo codeToMessage(4);
        return false;
        }
        else return true;
    }
}

//В случае, если при отправке формы файл выбран не был, PHP установит переменную $_FILES['userfile']['size']=0
//$_FILES['userfile']['tmp_name'] - none.


    function codeToMessage($code){
        switch ($code) {
            case 1:
                $message = "Размер принятого файла превысил максимально допустимый размер";
                break;
            case 2:
                $message = "Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.";
                break;
            case 3:
                $message = "Загружаемый файл был получен только частично.";
                break;
            case 4:
                $message = "Файл не был загружен";
                break;
            case 6:
                $message = "Отсутствует временная папка.";
                break;
            case 7:
                $message = "Не удалось записать файл на диск. ";
                break;
            case 8:
                $message = "PHP-расширение остановило загрузку файла" ;
                break;
    
            default:
                $message = "Неизвестная ошибка";
                break;
        }
        return $message;
    }
     
    

// файл во времмной папке
// информация по файлу в массиве $_FILES


// 1. проверка на тип (type)
// 2. проверка на размер (size в байтах)



// $_FILES: error
// https://www.php.net/manual/ru/features.file-upload.errors.php


// $_FILES['userfile']['name']
// Оригинальное имя файла на компьютере клиента.

// $_FILES['userfile']['type']
// Mime-тип файла, в случае, если браузер предоставил такую информацию. 
//В качестве примера можно привести "image/gif". 
//Этот mime-тип не проверяется на стороне PHP, так что не полагайтесь на его значение без проверки.

// $_FILES['userfile']['size']
// Размер в байтах принятого файла.

// $_FILES['userfile']['tmp_name']
// Временное имя, с которым принятый файл был сохранен на сервере.

// $_FILES['userfile']['error']
// Код ошибки, которая может возникнуть при загрузке файла.move_uploaded_file($tmp_name, "img/$name");