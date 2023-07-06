<?php
namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

class MessageHandleHelper {

    protected $apiSuccess  = 1;
    protected $apiError    = 0;

    private function _getErrorResponse(string $msg, array $data, int $statusCode = Response::HTTP_BAD_REQUEST) :array
    {
        $response = [
            'Status'    => $this->apiError,
            'Code'      => $statusCode,
            'Message'   => $msg,
            'Data'      => null,
            'Errors'    => ((is_array($data) && count($data) == 0)?null:$data),
        ];

        return $response;
    }

    private function _getSuccessResponse(string $msg, array $data, int $statusCode = Response::HTTP_OK) :array
    {
        $response = [
            'Status'    => $this->apiSuccess,
            'Message'   => $msg,
            'Code'      => $statusCode,
            'Data'      => ((is_array($data) && count($data) == 0)?null:$data),
            'Errors'    => null
        ];

        return $response;
    }

    #region HTTP Success Response

    // in case of any success requests of type >> ( get - put - delete )
    public function getJsonSuccessResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_OK;

        $response   = $this->_getSuccessResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of success creation requests of type >> ( post )
    public function postJsonSuccessResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_CREATED;

        $response   = $this->_getSuccessResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_CREATED);

    }


    // in case of user is not verified >> to send to verification
    public function getJsonNotAcceptedSuccessResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_NOT_ACCEPTABLE;

        $response   = $this->_getSuccessResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    #endregion



    #region HTTP Errors Response

    // in case of invalid payload (body - form-data) data or not exist
    public function getJsonBadRequestErrorResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_BAD_REQUEST;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    public function getJsonBadRequestErrorResponseWithRefresh(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_CONFLICT;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of not exist resource for end-point only >> ex. (/products/1)
    public function getJsonNotFoundErrorResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_NOT_FOUND;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of not authorized request that header authorization is not sent or not valid or expired
    public function getJsonNotAuthorizedResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_UNAUTHORIZED;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of user is not verified >> to send to verification
    public function getJsonNotAcceptedErrorResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_NOT_ACCEPTABLE;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of user session is expired and need special behaviour
    public function getJsonSessionExpiredErrorResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_PAYMENT_REQUIRED;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of client balance not sufficient
    public function getJsonClientNotEnoughBalanceErrorResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_METHOD_NOT_ALLOWED;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of error on validation for payload data for (body - form-data)
    public function getJsonValidationErrorResponse(string $msg = "", array $data = []) :object{

        if(isset($data[0]) && isset($data[0]["errorMsg"]))
        {
            $msg = $data[0]["errorMsg"];
        }

        $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of internal server error for (syntax - not handled error)
    public function getJsonInternalServerErrorResponse(string $msg = "", array $data = []) :object{

        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        $response   = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    #endregion
}
