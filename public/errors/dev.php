<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>

<h1>Произошла ошибка</h1>
<p><b>Код ошибки:</b> <?= $errorNo ?></p>
<p><b>Текст ошибки:</b> <?= $errorStr ?></p>
<p><b>Файл, в котором произошла ошибка:</b> <?= $errorFile ?></p>
<p><b>Строка, в которой произошла ошибка:</b> <?= $errorLine ?></p>

</body>
</html>