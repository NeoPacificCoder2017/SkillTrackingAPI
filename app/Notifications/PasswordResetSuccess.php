<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class PasswordResetSuccess extends Notification implements ShouldQueue
{
    use Queueable;
    
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct()
    {
        //
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
            ->line('Votre mot de passe à bien été modifié.')
            ->line('Si vous avez changer votre mot de passe, aucune autre action est nécéssaire.')
            ->line('Si vous n\'avez pas fais de demande de réinitialisation de mot de passe, pensez à sécuriser votre compte.');
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