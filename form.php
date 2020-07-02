<!doctype html>

<html lang="ru">

<head>

    <meta charset="UTF-8">

    <title>Загрузка файлов</title>
    <style>
        form div {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <form action="check_files_handler.php" method="post" enctype="multiple\form-data">
        <div> 
        <input type="file" accept="image/*" multiple name="pictures[]">
    </div>
    <div> 
        <input type="file" accept="image/*" multiple name="pictures[]">
    </div>
    <div> 
        <input type="file" accept="image/*" multiple name="pictures[]">
    </div>
    <div>
            <input type= "submit" value="Загрузить">
    </div>
    </form>

    <form action="link_short.php" method="post">
    <input type="url" name="url">
    <button type ="submit"> Сократить</button>
    </form>
    
    </body>
    </html>