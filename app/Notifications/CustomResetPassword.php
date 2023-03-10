<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('!Hola, Somos BookSale¡')
                    ->subject(Lang::get('Notificación de restablecimiento de contraseña BookSale'))
                    ->line(Lang::get('Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.'))
                    ->action(Lang::get('Cambiar Contraseña'), route('password.reset', ['token' => $this->token]))
                    ->line(Lang::get('Este enlace de restablecimiento de contraseña expirará en :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
                    ->salutation('Saludos');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
