<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

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
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => "Data yang diberikan salah.",
                'errors' => $exception->errors(),
                'error' => collect($exception->errors())->first()[0],
            ], $exception->status);
        }

        if ($exception instanceof ModelNotFoundException) {
            $model = $exception->getModel();
            $readableModelName = Str::title(str_replace('_', ' ', Str::snake(class_basename($model))));

            if (method_exists($model, 'getReadableClassName')) {
                $readableModelName = $model::getReadableClassName();
            }

            $error_message = 'Data ' . $readableModelName . ' tidak ditemukan';

            return response()->json([
                'model_ids' => $exception->getIds(),
                'errors' => [
                    '404' => [$error_message],
                ],
                'error' => $error_message
            ], 400);
        }

        return parent::render($request, $exception);
    }
}
