<?php

namespace App\Exceptions;

use Exception;

class SystemErrorException extends Exception
{
    protected $title, $message;

    public function __construct($title = '', $message = '', $code = 500, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

}
