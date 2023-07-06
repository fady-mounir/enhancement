<?php

namespace App\Http\Controllers;

use App\Helpers\MessageHandleHelper;
use App\Helpers\ValidationHelper;

class ApiController extends Controller
{
    protected $validator;
    protected $messageHandler;

    public function __construct()
    {
        $this->messageHandler = new MessageHandleHelper();
        $this->validator      = new ValidationHelper();
    }
}
