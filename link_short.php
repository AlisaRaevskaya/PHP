<?php


// //Реализовать сокращатель ссылок (пример):

// пользователь вводит url в поле формы (используйте input type="url")
// на сервере полученные данные необходимо обработать:
// проверка на пустоту,
// filter_var - FILTER_VALIDATE_URL
// trim
// если данные введены некорректно (то, что ввел пользоваль не url), сообщить об этом пользователю.
// если данные введены корректно:
// проверить присутствует ли в файле ссылка, которую ввел пользователь
// если ссылка присутствует, то получить короткую ссылку и вывести на экран.
// если ссылки еще нет, создать хеш определенной длины (алгоритм придумать самостоятельно). Если созданный хеш уже есть в файле, 
//то создавать новый до тех пор, пока хеш не станет уникальным. После этого записать хэш в файл
// Информация будет храниться в файле следующим образом:

//   длинная ссылка:короткая ссылка
//   например, 
//   https://github.com/web-ifmo/php/blob/master/tasks.md:https://wdvth.ru/P37en


// получаете из $_POST ссылку, которую ввел пользователь
$post = $_POST;
var_dump($post);
$userlink = $post["url"];
var_dump($userlink);
$filename = 'links.txt';//файл с ссылками
$max_len=10;

function reduce_url($userlink, $filename){
    if(check_ifempty($userlink)){
        trim(check_url($userlink))
        url_exists_in_file($filename, $userlink)
        reduce()
    }
}

//проверка на пустоту
function check_ifempty($userlink){ 
    if(empty($userlink)){
    echo "Сcылка не введена";//
    return false;
    }
    else{
    echo "Сcылка введена";
    return true;
    }
}

//// Корректность ссылки (URL)
function check_url($userlink){
if(filter_var($userlink, FILTER_VALIDATE_URL,FILTER_FLAG_SCHEME_REQUIRED,FILTER_FLAG_HOST_REQUIRED)!==false){
        echo"Ссылка корректна";
        return $userlink;
}else{//если данные введены некорректно
        echo"Введите корректную ссылку";//сообщить об этом пользователю.
        return false;
    } 
}


function url_exists_in_file($filename, $userlink){// проверить присутствует ли в файле ссылка, которую ввел пользователь
    
        $arr_data=file($filename, FILE_IGNORE_NEW_LINES |FILE_SKIP_EMPTY_LINES);//массив с ссылками
        if($arr_data!==false){//если ссылки считаываются в массив
        if(in_array($userlink, $arr_data)){//если есть ссылка в массиве
            echo"Ссылка есть в файле";
        return true;}
        else {
            echo "Ссылка новая"
            return false;
        }
    };// Читает массив с ссылками
    //Возвращает файл в виде массива. Каждый элемент массива соответствует строке файла, 
    //с символами новой строки включительно. В случае ошибки file() возвращает FALSE.



function reduce($url, $max_len, $filename ){
    $url_len = strlen($url);
    if($url_len > $max_len ){
    $url  = parse_url($url, PHP_URL_SCHEME)) . generateUrlName($max_len);

    if(url_exists_in_file($filename, $url)==!false){
        generateUrlName($max_len);
    }
}



function generateUrlName($max_len){ //генерация названия
$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
$url_name = substr($chars, rand(1, strlen($chars)), $max_len);
return $url_name ;
}

// var_dump($url);


// var_dump(parse_url($url));
// var_dump(parse_url($url, PHP_URL_SCHEME));
// var_dump(parse_url($url, PHP_URL_USER));
// var_dump(parse_url($url, PHP_URL_PASS));
// var_dump(parse_url($url, PHP_URL_HOST));
// var_dump(parse_url($url, PHP_URL_PORT));
// var_dump(parse_url($url, PHP_URL_PATH));
// var_dump(parse_url($url, PHP_URL_QUERY));
// var_dump(parse_url($url, PHP_URL_FRAGMENT));




// читаете данные из файла, проверяете, если ли в файле ссылка, которую ввел пользователь
// если есть, возвращаете пользователю соответствующую ей короткую ссылку


// если ссылки в файле нет, генерируете короткую ссылку,
// например, получится https://перт.ru/4еп8оо
// проверяете, что такой короткой ссылки нет в файле
// (если есть, генерируете заново и снова проверяете)
// записываете в файл длинную ссылку, которую ввел пользователь и сгенерированную короткую,
// в файле появится новая строчка:
// https://www.php.net/manual/ru/function.fwrite.php#https://перт.ru/4еп8оо
// короткую ссылку отображаете пользователю:
//echo 'https://перт.ru/4еп8оо';
//
?>


<!--ссылка в файле присутствует-->
<!-- пользователь вводит url,
например, https://github.com/web-ifmo/php/blob/master/tasks.md
нажимает Сократить-->

<!--ссылки в файле нет-->
<!-- пользователь вводит url,
например, https://www.php.net/manual/ru/function.fwrite.php
нажимает Сократить-->
