<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        VerifyEmail::toMailUsing(function ($notify, $url) {
            return (new MailMessage)
                ->subject("Verificar cuenta")
                ->line('Tu cuenta ya está casi lista, solo debes presionar el enlance')
                ->action('Confirmar cuenta', $url);
        });
    }
}
