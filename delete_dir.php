<?php
//Написать функцию удаления непустого каталога. Использовать рекурсивный вызов функции.

$ext = 'txt';

for ($i=0; $i<3 ; $i++){//3 папки
$dir=create_dir()
opendir($dir);//открываем папку
for($i=0; $i<3 ; $i++){
    create_file()
    for($i=0; $i<3 ; $i++){
        create_dir(){
}
};

function create_dir(){
    $dirname = uniqid('', true); //генерация названия/
    mkdir($dirname);//создание папок со сгенерированным названием
    echo($dirname);
}
function create_file(){
    fopen(uniqid() . '.' . $ext, "+w");
}

//'w+'	Открывает файл для чтения и записи; помещает указатель в начало файла и обрезает файл до нулевой длины. Если файл не существует - пытается его создать.



if($dir_main && $dir_second){
    echo "Папка создана";   
}else{
    echo "Папка НЕ создана";
}


function delete($dir){
    if(is_dir($dir)){//если это папка
    
    if(($dh=opendir($dir))!==false){ //если папка не пустая

        while(($file=readdir($dh))!==false){//пока есть элементы декриптора, 
            if($file !== "." && $file !== '..' ){  //исключить значения "." и "..".
                if(is_file($file)){ //если элемент-файл
                unlink($file);//удаляем элемент;
                }else {
                delete($file); //запускаем функцию снаала
                }  
            }
        }
        closedir($dh);
        rmdir($dir); //удаляем папку 
        echo"Папка удалена"; 
    }
    }

delete($dir_main);
 //opendir- Возвращает дескриптор каталога (resource) в случае успеха или FALSE в случае возникновения ошибки
 //readdir - получает элемент каталога по его дескриптору


