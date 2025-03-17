<?php 

class BaseController {
    protected function render(string $view, array $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../views/pages/$view.php";
    }
}