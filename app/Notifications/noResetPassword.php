<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class noResetPassword extends Notification
{
    use Queueable;

    protected $token;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->token = $token;
        $this->user = $user;
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
        $url = 'http://127.0.0.1:3000/user/password/change?token=' . $this->token . '&email=' . $this->user->email;
        return (new MailMessage)
                    ->subject('Davichat - Xác nhận mật khẩu!')
                    ->from($this->user->email, 'Davichat - Đại Việt')
                    ->greeting('Davichat - Xác nhận mật khẩu!')
                    ->line('Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.')
                    ->action('Đổi mật khẩu', $url)
                    ->line('Liên kết đặt lại mật khẩu này sẽ hết hạn sau 60 phút.');
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
