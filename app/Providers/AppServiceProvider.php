<?php

namespace CodeFlix\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Bootstrapper\Form;
use CodeFlix\Exceptions\SubscriptionInvalidException;
use CodeFlix\Models\Video;
use Dingo\Api\Exception\Handler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Code\Validator\Cpf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Video::updated(function ($video) {
            if (!$video->completed) {
                if ($video->file != null && $video->thumb != null && $video->duration != null) {
                    $video->completed = true;
                    $video->save();
                }
            }
        });

        \Validator::extend('cpf', function($attribute, $value, $parameters, $validator){
            return (new Cpf())->isValid($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
        }

        $this->app->bind(
            'bootstrapper::form',
            function ($app) {
                $form = new Form(
                    $app->make('collective::html'),
                    $app->make('url'),
                    $app->make('view'),
                    $app['session.store']->token()
                );

                return $form->setSessionStore($app['session.store']);
            },
            true
        );

        $handlerApi = app(Handler::class);
        $handlerApi->register(function (AuthenticationException $exception) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        });

        $handlerApi->register(function (JWTException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        });

        $handlerApi->register(function (ValidationException $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
                'validation_errors' => $exception->validator->getMessageBag()->toArray()
            ], 422);
        });

        $handlerApi->register(function (SubscriptionInvalidException $exception) {
            return response()->json([
                'error' => 'subscription_valid_not_found',
                'message' => $exception->getMessage()
            ], 403);
        });
    }
}
