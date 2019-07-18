<?php

$fileToDelete = '20150801_121810.jpg';
$init = false;
$res = deleteFile($uploadsDir, $fileToDelete, $init);

function deleteFile($dir = '', $fileName = '', $init = false) {

    if (!$init) return;

    if (is_dir($dir)) {
        $d = scandir($dir);
        
        if (in_array($fileName, $d)) {
            unlink($dir.$fileName);
            echo 'File has been successfully removed!';
        };
    };
};