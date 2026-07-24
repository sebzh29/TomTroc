<?php

class ErrorController
{
    public function notFound()
    {
        http_response_code(404);
        require 'views/errors/404.php';
    }
}