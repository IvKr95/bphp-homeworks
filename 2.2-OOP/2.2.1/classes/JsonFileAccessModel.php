<?php

class JsonFileAccessModel 
{

    protected $fileName;
    protected $file;

    public function __construct($fileName)
    {
        $this->fileName = Config::DATABASE_PATH.'/'.$fileName.'.json';
    }

    protected function __destruct()
    {
        
    }

    private function connect($mode)
    {
        $this->file = fopen($this->fileName, $mode);

        if ($this->file === false) {
            exit('Failed to open stream');
        };
    }

    private function disconnect()
    {
        fclose($this->file);
    }

    public function read()
    {
        $this::connect('r');
        $data = fread($this->file, filesize($this->fileName));
        $this::disconnect();
        return $data;
    }

    public function write($text)
    {
        $this::connect('w');
        fwrite($this->file, $text);
        $this::disconnect();
    }

    public function readJson()
    {
        $this::connect('r');
        $data = fread($this->file, filesize($this->fileName));
        $this::disconnect();
        return json_decode($data);
    }

    public function writeJson($text)
    {
        $json = json_encode($text, JSON_PRETTY_PRINT);
        $this::connect('w');
        fwrite($this->file, $json);
        $this::disconnect();
    }
};
