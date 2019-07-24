<?php

$uploadsDir = __DIR__ . '/uploads/';
$fileName = 'picture';
$isUploaded = uploadFileToDir($uploadsDir, $fileName);

function uploadFileToDir($uploadsDir='', $fileName='') 
{
    $extType = [
        'gif', 
        'jpg', 
        'jpe', 
        'jpeg', 
        'png',
    ];

    if ($_FILES[$fileName]['error'] === 0) {

        $tmpName = $_FILES[$fileName]['tmp_name'];
        
        if (is_uploaded_file($tmpName)) {
        // Использование этой функции целесообразно для удостоверения,
        // что злонамеренный пользователь не пытается обмануть скрипт так,
        // чтобы он работал с файлами, с которыми работать не должен - к примеру,
        // /etc/passwd.
            $pathParts = pathinfo($_FILES[$fileName]['name']);
            
            if (in_array($pathParts['extension'], $extType)) {

                return move_uploaded_file(
                    $tmpName,
                    $uploadsDir.$pathParts['basename']
                );
            };
        };
    };
};