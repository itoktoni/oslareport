<?php

namespace App\Exceptions;

use Doctrine\DBAL\Query\QueryException;
use GuzzleHttp\Client;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Plugins\Notes;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
    public function register(): void {}

    private function checkError(Throwable $e)
    {
        if ($e->getMessage() == 'The route vendors/bundle.css could not be found.') {
            return true;
        }

        if ($e->getMessage() == 'CSRF token mismatch.') {
            return true;
        }

        if ($e->getMessage() == 'The route public/storage/logo.png could not be found.') {
            return true;
        }

        if ($e->getMessage() == 'The GET method is not supported for route api/barcode.') {
            return true;
        }

        if ($e->getMessage() == 'The route _profiler/phpinfo could not be found.') {
            return true;
        }

        if ($e->getMessage() == 'Unauthenticated.') {
            return true;
        }

        return false;
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        Log::error($e->getMessage());
        if (! empty(env('BOT_TELEGRAM')) && ! empty(env('TELEGRAM_ID'))) {
            $client = new Client;
            $url = 'https://api.telegram.org/bot'.env('BOT_TELEGRAM').'/sendMessage'; //<== ganti jadi token yang kita tadi

            $data = $this->buildMessage(
                'File : '.$e->getFile().
                            "\nLine : ".$e->getLine().
                            "\nCode : ".$e->getCode().
                            "\nMessage : ".$e->getMessage().
                            "\nUrl : ".request()->getUri().
                            "\nMethod : ".request()->getMethod().
                            "\nRequest : ".json_encode(request()->all(), JSON_PRETTY_PRINT)
            );

            if (! $this->checkError($e)) {
                $client->request('GET', $url, $data);
            }
        }

        if (request()->hasHeader('authorization')) {

            if ($e instanceof ValidationException) {
                return Notes::validation($e->getMessage());
            }

            if ($e instanceof ModelNotFoundException) {
                return Notes::error($e->getMessage());
            }

            if ($e instanceof NotFoundHttpException) {
                return Notes::error($e->getMessage());
            }

            if ($e instanceof QueryException) {
                return Notes::error($e->getMessage());
            }

            return Notes::error($e->getMessage(), 'Error '.$e->getCode());
        }

        $e = $this->mapException($e);

        if (method_exists($e, 'render') && $response = $e->render($request)) {
            return Router::toResponse($request, $response);
        }

        $e = $this->prepareException($e);

        if ($response = $this->renderViaCallbacks($request, $e)) {
            return $response;
        }

        return match (true) {
            $e instanceof HttpResponseException => $e->getResponse(),
            $e instanceof AuthenticationException => $this->unauthenticated($request, $e),
            $e instanceof ValidationException => $this->convertValidationExceptionToResponse($e, $request),
            default => $this->renderExceptionResponse($request, $e),
        };
    }

    private function buildMessage($message)
    {
        $data = ['json' => [
            'chat_id' => env('TELEGRAM_ID'), //<== ganti dengan id_message yang kita dapat tadi
            'text' => $message,
        ],
        ];

        return $data;
    }
}
