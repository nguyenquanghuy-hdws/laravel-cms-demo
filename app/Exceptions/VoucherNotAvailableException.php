<?php

namespace App\Exceptions;

use Exception;

class VoucherNotAvailableException extends Exception
{
    protected $title, $message;

    public function __construct($title = 'Get voucher failed', $message = 'There is no more available voucher.', $code = 404, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }
}
