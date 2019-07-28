<?php

require 'uploadToDir.php';
include 'deleteFile.php';

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
    <form enctype="multipart/form-data" action="#" method="post" name="pic_upload">
        <input type="file" name="picture">
        <input type="submit" value="Отправить" name="submit">
    </form>
    <div>
    
        <?php 

        if(is_dir($uploadsDir)) {

            $files = scandir($uploadsDir);

            foreach ($files as $key => $file) 
            {
                if ($file === '.' || $file === '..') continue;
                $src = str_replace($_SERVER['DOCUMENT_ROOT'], '', $uploadsDir);

                echo "<img src=\"$src$file\" alt=\"pic\" width=\"300px\"><br>";
                
            };
            echo '<div>Files have been successfully uploaded!</div>';
        };

        ?>
    </div>
</body>
</html>
