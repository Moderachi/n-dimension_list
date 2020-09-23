
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/template/css/main.css">
    <!-- Bootstrap Последняя компиляция и сжатый CSS -->  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title><?php if(isset($titlePage)) echo $titlePage; else echo trim($_SERVER['REQUEST_URI'], '/'); ?></title>
</head>

<body>
    <div class="header">
        <h1 class="text-center">Тестовое задание ПервыйБит</h1>
        <div class="text-center">
        <h3 class="sub-title">Реализация каталога n-ой вложенности</h3></div>
    </div>
    <div class="container">
        
