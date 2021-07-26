<?php

namespace App\Exceptions;


class NotFoundException extends BaseException
{

    public function __construct(string $key)
    {
        parent::__construct($this->generateMessage('found', $key));
    }

}