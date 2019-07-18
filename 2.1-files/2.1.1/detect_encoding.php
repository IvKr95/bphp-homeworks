<?php

if ( !function_exists('mb_detect_encoding') ) { 
    
    function mb_detect_encoding ($string, $enc=null, $ret=null) 
    {

        static $enclist = [ 
            'UTF-8', 'ASCII', 
            'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4', 'ISO-8859-5', 
            'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9', 'ISO-8859-10', 
            'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16', 
            'Windows-1251', 'Windows-1252', 'Windows-1254', 
        ];

        $result = false; 

        foreach ($enclist as $item) 
        { 
            $sample = iconv($item, $item, $string);

            if (md5($sample) == md5($string)) { 
                if ($ret === NULL) { 
                    $result = $item; 
                } else { 
                    $result = true; 
                };
                break; 
            };
        };
        
        return $result; 
    };
};