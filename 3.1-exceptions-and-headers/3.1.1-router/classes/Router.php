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
        return in_array($pageName, $this->availLinks);
    }
};