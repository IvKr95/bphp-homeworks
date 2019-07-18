<?php

if (!mb_detect_encoding($jsonText, 'UTF-8', true)) {
    $inCharset = mb_detect_encoding($jsonText);
    $jsonText = iconv($inCharset, 'UTF-8', $jsonText);
};