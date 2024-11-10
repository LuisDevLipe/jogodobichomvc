<?php

namespace Core;

class View
{
    protected $path = '../App/Views';
    protected $folder;
    protected $file;
    protected $viewPath;

    public function __construct($viewPath)
    {
        $viewPath = explode('/', $viewPath);
        $this->folder = $viewPath[0];
        $this->file = $viewPath[1] ?? 'index';
        $this->viewPath = "$this->path/$this->folder/$this->file.php";
    }
    public function render($data = [])
    {

        if (file_exists($this->viewPath)) {
            require_once $this->viewPath;
        } else {
            echo 'View not found';
            die();
        }
    }
}
