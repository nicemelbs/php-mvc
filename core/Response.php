<?php

namespace app\core;

class Response
{
    public function setStatusCode($httpCode)
    {
        http_response_code($httpCode);
    }

}