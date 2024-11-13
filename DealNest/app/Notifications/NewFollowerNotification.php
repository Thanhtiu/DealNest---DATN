<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewFollowerNotification extends Notification
{
    use Queueable;

    protected $follower;

    /**
     * Tạo một thông báo mới
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    /**
     * Lấy các kênh gửi thông báo.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Chuyển thông báo sang dạng lưu trữ trong cơ sở dữ liệu
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->follower->name . ' đã theo dõi bạn.',
            'follower_name' => $this->follower->name,
            'follower_id' => $this->follower->id,
        ];
    }
}

