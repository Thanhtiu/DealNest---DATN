<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductUpdatedNotification extends Notification
{
    use Queueable;

    protected $product;
    /**
     * Create a new notification instance.
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        if ($this->product->status === 'cancel') {
            // Nếu trạng thái là 'cancel', sử dụng lý do từ 'note'
            $message = 'Sản phẩm ' . $this->product->name . ' đã bị từ chối. Lý do: ' . $this->product->note;
        } else {
            // Nếu trạng thái không phải 'cancel', thông báo sản phẩm đã được duyệt
            $message = 'Sản phẩm ' . $this->product->name . ' đã được phê duyệt!';
        }
        return [
            'message' => $message,
            'product_name' => $this->product->name,
            'product_id' => $this->product->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
