<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Здравствуйте!')
            ->subject('Восстановление пароля к Личному кабинету Магия-Доставка')
            ->line('Перейдите по ссылке ниже для восстановления пароля.')
            ->line('С уважением Магия-Доставка!')
            ->action('Сброс пароля', url('password/newPassword', [$this->token, $notifiable] ))
            ->line('Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется. ')
            ->line('Обратитесь в контактый центр Магия-Доставка +7 (978) 103 07 67.');
    }
}
