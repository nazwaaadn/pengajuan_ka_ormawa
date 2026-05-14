<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PengajuanNotifikasi extends Notification
{
    use Queueable;
    public $pengajuan;
    public $status;
    public $isForStaff;

    /**
     * Create a new notification instance.
     */
    public function __construct($pengajuan, $status, $isForStaff)
    {
        $this->status = $status;
        $this->pengajuan = $pengajuan;
        $this->isForStaff = $isForStaff;
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

        if ($this->isForStaff) {
            switch ($this->status) {
                case 'baru':
                    $mail->line('Ada pengajuan baru yang masuk.')
                        ->line('Diajukan oleh: ' . $this->pengajuan['nama'])
                        ->line('ORMAWA: ' . $this->pengajuan['ketua_ormawa'])
                        ->line('Periode: ' . $this->pengajuan['periode'])
                        ->line('Pengajuan siap diperiksa.');
                    break;
                case 'revisi_dikirim':
                    $mail->line('Ada revisi pengajuan yang dikirim kembali.')
                        ->line('Diajukan oleh: ' . $this->pengajuan['nama'])
                        ->line('ORMAWA: ' . $this->pengajuan['ketua_ormawa'])
                        ->line('Periode: ' . $this->pengajuan['periode'])
                        ->line('Revisi siap diperiksa.');
                    break;
            }
        } else {
            switch ($this->status) {
                case 'baru':
                    $mail->line('Pengajuan baru telah dikirim oleh: ' . $this->pengajuan['nama'])
                        ->line('ORMAWA: ' . $this->pengajuan['ketua_ormawa'])
                        ->line('Periode: ' . $this->pengajuan['periode'])
                        ->line('Pengajuan sedang diproses.');
                    break;
                case 'revisi':
                    $mail->line('Pengajuan Anda perlu untuk revisi.')
                        ->line('Silakan cek website untuk melakukan revisi sesuai dengan catatan.');
                    break;
                case 'revisi_dikirim':
                    $mail->line('Revisi pengajuan Anda berhasil dikirim kembali.')
                        ->line('Silakan menunggu info lebih lanjut.');
                    break;
                case 'diterima':
                    $mail->line('Pengajuan Anda telah diterima.')
                        ->line('Silakan menunggu untuk penurunan SK.');
                    break;
                    // case 'sk_terbit':
                    //     $mail->line('Surat Keputusan (SK) telah diterbitkan.')
                    //         ->line('Silakan cek website untuk informasi lebih lanjut.');
                    break;
            }
        }

        return $mail->line('Terima kasih telah menggunakan sistem pengajuan kami!');

        // return (new MailMessage)
        //     ->subject('Pengajuan Baru Dikirim')
        //     ->line('Pengajuan baru telah dikirim oleh: ' . $this->pengajuan['nama'])
        //     ->line('ORMAWA: ' . $this->pengajuan['ketua_ormawa'])
        //     ->line('Periode: ' . $this->pengajuan['periode'])
        //     // ->action('Lihat Pengajuan', url('/pengajuanberkas'))
        //     ->line('Terima kasih telah menggunakan sistem pengajuan kami!');
    }

    public function toDatabase($notifiable)
    {
        $message = $this->isForStaff
            ? $this->getStaffMessage()
            : $this->getMessage();

        return [
            'nama' => $this->pengajuan ? $this->pengajuan['nama'] : 'Pengajuan tidak tersedia',
            'ketua_ormawa' => $this->pengajuan ? $this->pengajuan['ketua_ormawa'] : 'Informasi ORMAWA tidak tersedia',
            'periode' => $this->pengajuan ? $this->pengajuan['periode'] : 'Informasi periode tidak tersedia',
            'message' => $message,
            // 'url' => url('/pengajuan/' . $this->pengajuan['id']),
            'status' => $this->status,
            'role_target' => $this->isForStaff ? 'staff_kemahasiswaan' : 'mahasiswa', // Important for filtering
        ];
    }

    /**
     * Get notification message based on status.
     */
    private function getMessage(): string
    {
        if (!$this->pengajuan) {
            return 'Informasi pengajuan tidak tersedia.';
        }

        switch ($this->status) {
            case 'baru':
                return 'Pengajuan baru Anda berhasil dikirim. Silakan menunggu untuk proses selanjutnya.';
            case 'revisi':
                return 'Pengajuan Anda perlu revisi. Silakan cek halaman pengajuan untuk informasi lebih lanjut.';
            case 'revisi_dikirim':
                return 'Revisi pengajuan Anda berhasil dikirim. Silakan menunggu untuk proses selanjutnya.';
            case 'diterima':
                return 'Pengajuan Anda telah diterima. Silakan menunggu untuk penerbitan SK.';
                // case 'sk_terbit':
                //     return 'Surat Keputusan (SK) telah diterbitkan. Silakan cek halaman pengajuan untuk informasi lebih lanjut.';
            default:
                return 'Informasi pengajuan.';
        }
    }

    /**
     * Get notification message for staff.
     */
    private function getStaffMessage(): string
    {
        if (!$this->pengajuan) {
            return 'Pemberitahuan terkait pengajuan tidak tersedia.';
        }

        switch ($this->status) {
            case 'baru':
                return 'Pemberitahuan terkait pengajuan baru yang masuk untuk diperiksa.';
            case 'revisi_dikirim':
                return 'Pemberitahuan terkait revisi pengajuan yang dikirim kembali untuk diperiksa.';
            default:
                return 'Informasi pengajuan untuk staf.';
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $message = $this->isForStaff
            ? $this->getStaffMessage()
            : $this->getMessage();

        return [
            'pengajuan' => $this->pengajuan,
            'message' => $message,
            'status' => $this->status
        ];
    }
}
