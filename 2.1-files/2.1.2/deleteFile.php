<?php

if(isset($_POST['delete'])) {
    deleteFile($_POST['fileToDelete'], $uploadsDir);
};

function deleteFile($fileName, $dir)
{
    if (file_exists($dir.$fileName)) {
        unlink($dir.$fileName);
        echo 'File successfully deleted';
    } else {
        echo 'File Not Exist';
    }
};
