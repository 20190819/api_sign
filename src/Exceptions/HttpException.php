<?php

namespace Young\ApiSign\Exceptions;

use Exception;

class HttpException extends Exception
{
    public $exception;

    public function __construct($message = "", $code = 0, Exception $exception = null)
    {
        parent::__construct($message, $code, $exception);
        $this->exception = $exception;
    }

    public function render()
    {
        $error = [
            'code' => $this->code,
            'msg' => $this->message
        ];
        if ($this->exception) {
            $error['error'] = [
                'msg' => $this->exception->getMessage(),
                'code' => $this->exception->getCode()
            ];
        }
        return response()->json($error, 200);
    }
}
