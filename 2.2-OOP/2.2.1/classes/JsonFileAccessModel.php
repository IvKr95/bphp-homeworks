<?php

class JsonFileAccessModel extends FileAccessModel
{

    public function readJson()
    {
        $this->connect('r');

        if (is_readable($this->fileName)) {
            $data = fread($this->file, filesize($this->fileName));
        };
        $this->disconnect();
        return $data;
    }

    public function writeJson($text)
    {
        $json = json_encode($text, JSON_PRETTY_PRINT);

        $this->connect('w');
        if (is_writable($this->fileName)) {
            fwrite($this->file, $json);
        };
        $this->disconnect();
    }
};
