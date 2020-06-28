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
$uploaddir = 'img';
// $allowedTypes = array('image/gif', 'image/png', 'image/jpeg');


   

if(ifExists($files)){
    //если кнопка "Submit" нажата, и файл уже загружен на сервер 
    //
    if(checkType($file_type) && checkSize($file_size)){
    foreach($file_name as $f_name){
    $ext = pathinfo($f_name, PATHINFO_EXTENSION);
    $name= md5($f_name. microtime().rand(0, 999));
    $name.=".$ext";
    move_uploaded_file($tmp_name, "$uploads_dir/$name");
    checkError($file_error); //UPLOAD_ERR_OK ==true
    }else
    foreach($file_name as $f_name){
        echo "Файл $f_name не загружен." . checkError($file_error);
    }
}
    };
   
 
// //проверка на существование формы
function ifExists($array){
    if(isset($array)) {//
        return true;       
   }else{
    echo codeToMessage(UPLOAD_ERR_NO_FILE);
    return false;
   }
   
}   

function checkError($array){
    foreach($array as $key => $error){
    if ($error === UPLOAD_ERR_OK) {
        echo"Файл успешно загружен";
        return true;
        }else{
        echo codeToMessage($error);
        }


//валидация изображения

//проверка типа//$files['pictures']['type']
function checkType($array){
    foreach($array as $key => $type){
if (mime_content_type($type) == "image/gif"||mime_content_type($type)==="image/jpg"||mime_content_type($type)'image/png' )
    return true;
}else{
    echo "Извините, разрешено только файлы JPG, JPEG, PNG и GIF." . codeToMessage(UPLOAD_ERR_EXTENSION) ;
    return false;
}
}
}


//проверка размера
function checkSize($array){
foreach ($array as $key => $file_size){
if ($file_size> 4000){
    echo codeToMessage(UPLOAD_ERR_INI_SIZE);
}elseif($file_size===0){
 echo codeToMessage(UPLOAD_ERR_NO_FILE);
}else return true;
}
}

//В случае, если при отправке формы файл выбран не был, PHP установит переменную $_FILES['userfile']['size']=0
//$_FILES['userfile']['tmp_name'] - none.


    function codeToMessage($code){
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "Размер принятого файла превысил максимально допустимый размер";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "Загружаемый файл был получен только частично.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "Файл не был загружен";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Отсутствует временная папка.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Не удалось записать файл на диск. ";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "PHP-расширение остановило загрузку файла" ;
                break;
    
            default:
                $message = "Неизвестная ошибка";
                break;
        }
        return $message;
    }
}
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