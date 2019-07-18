<?php

$uploadsDir = __DIR__.'/uploads/';
$fileName = 'picture';
$isUploaded = uploadFileToDir($uploadsDir, $fileName);

function uploadFileToDir($uploadsDir='', $fileName='') 
{
    $extType = ['gif','jpg','jpe','jpeg','png'];

    if ($_FILES[$fileName]['error'] === 0) {

        $tmpName = $_FILES[$fileName]['tmp_name'];
        
        if (is_uploaded_file($tmpName)) {
        // Использование этой функции целесообразно для удостоверения,
        // что злонамеренный пользователь не пытается обмануть скрипт так,
        // чтобы он работал с файлами, с которыми работать не должен - к примеру,
        // /etc/passwd.
            $pathParts = pathinfo($_FILES[$fileName]['name']);
            
            if (in_array($pathParts['extension'], $extType)) {

                echo 'Success!';

                return move_uploaded_file(
                    $tmpName,
                    $uploadsDir.$pathParts['basename']
                );
            };
        };
    };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <?php 
        
        if($isUploaded) {
            if (is_dir($uploadsDir)) {
                if($dh = opendir($uploadsDir)) {
                    while ($file = readdir($dh)) {
                        if ($file === '.' || $file === '..') continue;
                        $src = str_replace($_SERVER['DOCUMENT_ROOT'], '', $uploadsDir);

                        echo "<img src=\"$src$file\" alt=\"pic\" width=\"300px\"><br>";
                        
                    };
                };
                closedir($dh);
            };
        };
        
        $res = deleteFile($uploadsDir, '20150801_121810.jpg');

        function deleteFile($dir, $fileName) {
    
            if (is_dir($dir)) {
                $d = scandir($dir);

                if (in_array($fileName, $d)) {
                    unlink($dir.$fileName);
                };
            };
        };

        ?>
    </div>
</body>
</html>
