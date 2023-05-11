<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException as QueryException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof QueryException){
            $errorCode = $exception->errorInfo[1];          
            switch ($errorCode) {
                case 1062://code dublicate entry 
                    return response([
                        'errors'=>'já cadastrado no banco de dados'
                    ],500);    
                    break;
                case 1364:// you can handel any auther error
                    return response([
                        'errors'=>$exception->getMessage()
                    ],Response::HTTP_NOT_FOUND);                        
                    break;      
            }
         }
        return parent::render($request, $exception);
    }
}
