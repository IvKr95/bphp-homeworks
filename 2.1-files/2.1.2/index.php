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

        require 'uploadToDir.php';

        if($isUploaded) {
            if (is_dir($uploadsDir)) {
                if($dh = opendir($uploadsDir)) {
                    while ($file = readdir($dh)) {
                        if ($file === '.' || $file === '..') continue;
                        $src = str_replace($_SERVER['DOCUMENT_ROOT'], '', $uploadsDir);

                        echo "<img src=\"$src$file\" alt=\"pic\" width=\"300px\"><br>";
                    };
                    echo '<div>Files has been successfully uploaded!</div>';
                };
                closedir($dh);
            };
        };

        include 'deleteFile.php';
        ?>
    </div>
</body>
</html>
