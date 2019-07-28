<?php


function deleteFile($dir = '', $fileName = '') 
{

    if (is_dir($dir)) {

        $d = scandir($dir);
        
        if (in_array($fileName, $d)) {
            unlink($dir.$fileName);
            echo 'File has been successfully removed!';
        };
    };
};