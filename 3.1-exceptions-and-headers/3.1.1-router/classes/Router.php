<?php


class Router
{
    public $availLinks;

    public function __construct($availableLinks)
    {
        $this->availLinks = $availableLinks;
    }

    public function isAvailablePage($pageName)
    {
        if(in_array($pageName, $this->availLinks)) {
            echo "Вы находитесь на странице <b>$pageName</b>";
            return true;
        } else {
            throw new NotFound('Page Not Found');
        };
    }
};