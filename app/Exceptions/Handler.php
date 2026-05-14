<?php

namespace App\Exceptions;

use Exception;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Handler extends Exception
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        // Di sini Anda bisa menambahkan log atau melaporkan exception
        Log::error($exception->getMessage());

        // Jangan lupa panggil parent report
        // parent::report($exception);
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
        // Menangani pengecualian 404
        if ($exception instanceof NotFoundHttpException) {
            return redirect()->route('error.404');  // Ganti dengan route untuk halaman 404
        }

        // Menangani pengecualian 500 (internal server error)
        if ($exception instanceof \ErrorException) {
            return redirect()->route('error.500');  // Ganti dengan route untuk halaman 500
        }

        // Menangani pengecualian database seperti QueryException
        if ($exception instanceof QueryException) {
            return redirect()->route('error.500');  // Ganti dengan route untuk halaman 500
        }

        // Jika exception lainnya, panggil parent render
        // return parent::render($request, $exception);
    }
}
