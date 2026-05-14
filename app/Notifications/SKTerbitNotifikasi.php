<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SKTerbitNotifikasi extends Notification
{
    use Queueable;
    public $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)->subject('Notifikasi Pengajuan');

        $mail->line('Surat Keputusan (SK) telah diterbitkan.')
            ->line('Silakan cek website untuk informasi lebih lanjut.');

        return $mail->line('Terima kasih telah menggunakan sistem pengajuan kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Surat Keputusan (SK) telah diterbitkan.',
            'status' => $this->status,
            'role_target' => 'mahasiswa',
        ];
    }
}
