<?php

namespace App\Exceptions;

use App\Helpers\MessageHandleHelper;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    private MessageHandleHelper $messageHandleHelper;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->messageHandleHelper = new MessageHandleHelper();
    }

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($this->isApiRequest($request)) {

            //IF it dataBase Transaction IT Will Be Rollback
            DB::rollback();

            //Prepare The Msg
            $msg = $this->prepareErrorMsgResponse($exception);

            //Notify The Developer
            $this->_notifyDeveloper($msg);

            //Return With Response
            return $this->messageHandleHelper->getJsonInternalServerErrorResponse($msg);
        }

        return parent::render($request, $exception); // TODO: Change the autogenerated stub
    }


    private function isApiRequest(Request $request):bool
    {
        return $request->is('api/*');
    }

    private function prepareErrorMsgResponse($exception):string
    {
        $exceptionFile = $exception->getFile();
        $exceptionLine = $exception->getLine();
        $exceptionMsg  = $exception->getMessage();
        return "File : $exceptionFile - Line : $exceptionLine - Error : " . $exceptionMsg;
    }

    private function _notifyDeveloper():void
    {
        //todo IT Will be Implement
    }
}
