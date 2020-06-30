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

$arr_data=file($filename, FILE_IGNORE_NEW_LINES |FILE_SKIP_EMPTY_LINES);//массив из файла
$max_len=10;//макс длина сокращенной ссылки

function reduce_url($userlink, $filename, $max_len, $arr_data){

    if(checkLinkIsset($userlink)){//если в поле есть ссылка

        $userlink=trim(check_url($userlink));//убираем пробелы в ссылке + проверка на корректность

        $file = fopen($filename, "w+");//Открываем файл для чтения и записи; помещает указатель в начало файла и обрезает 
        //файл до нулевой длины. Если файл не существует - пытается его создать.

            if(url_exists_in_file($userlink,$arr_data)){// если ссылка уже есть в массиве файла $file
            $existentShortUrl = findExistentShortURL($arr_data, $userlink, $max_len));// находим имеющуюся сокращенную ссылку в файле
            echo $existentShortUrl;//показываем ее
            }else{//если ссылка новая
            $newShortUrl =  reduce_rename_url($userlink, $max_len, $file);//сокращаем и называем новую ссылку
            echo $newShortUrl;//показываем
            record_shortURL($arr_data, $newShortUrl, $userlink);//записываем в файл;
            }
    }else {//если в поле нет ссылки
    echo "Сcылка не введена";
    return false;
}
}

//проверка на пустоту поля
function checkLinkIsset($userlink){ 
    if(isset($userlink)){
    echo "Сcылка введена";
    return true;
    }
};

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

//проверка на существование ссылки в файле
function url_exists_in_file($userlink,$arr_data){// проверить присутствует ли в файле ссылка, которую ввел пользователь
        if($arr_data!==false){//если ссылки считываются в массив
            if(in_array($userlink, $arr_data)){//если ссылка уже в массиве
            return true; 
        }
    };

// Информация будет храниться в файле следующим образом:
//   длинная ссылка:короткая ссылка
//находим короткую ссылку
function findExistentShortURL($arr_data, $userlink,$max_len){ 
    $string = implode(":", $arr_data);//объединяем массив ссылок в строку c разделителем :
    $shortlink = substr($string, strlen($userlink), $max_len);
    //Возвращает подстроку строки string, начинающейся с последнего символа длинной ссылки,  длиной max_length символов.
    return $shortlink;
}

//функция чтобы сократить и переимновать название ссылки
function reduce_rename_url($url, $max_len, $file){
    $url_len = strlen($url);//длина ссылки
    if($url_len > $max_len ){
        $http  = parse_url($url, PHP_URL_SCHEME));// http
        $shortlink = $http . generateUrlName($max_len); //короткая ссылка http+ new url name
        return $shortlink;
    }
}


//генерация названия длиной max_len
function generateUrlName($max_len){ 
$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
$url_name = substr($chars, rand(1, strlen($chars)), $max_len);
return $url_name;
}

//substr(вх.строка $string ,с какого символа int $start , int $length  ) : string
// var_dump($url);

//запись сокращенной ссылки в файл после длинной
function record_shortURL($arr_data, $newUrl, $userlink){
    $key = array_search($userlink, $arr_data);//Возвращает ключ для $userlink
    foreach($arr_data as $link){ //перебор массива
    $arr_data[$key]= $userlink . ": $newUrl";// соединяем строки старой ссылки с новой в элементе массива
    }
}
