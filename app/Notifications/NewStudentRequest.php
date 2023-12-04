<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewStudentRequest extends Notification
{
    use Queueable;

    public $applicationData;

    public function __construct($applicationData)
    {
        $this->applicationData = $applicationData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('طلب طالب جديد: ' . $this->applicationData['name'])
            ->greeting('مرحبًا!')
            ->line('تم تقديم طلب طالب جديد.')
            ->line('بيانات الطلب:')
            ->line('الاسم: ' . $this->applicationData['name'])
            ->line('الهوية: ' . $this->applicationData['identification'])
            ->line('تاريخ الميلاد: ' . $this->applicationData['birth_date'])
            ->line('مكان الميلاد: ' . $this->applicationData['birth_place'])
            ->line('حالة الأسرة: ' . trans('options.'. $this->applicationData['family_status']))
            ->line('اسم الأم: ' . $this->applicationData['mother_name'])
            ->line('هاتف الأم: ' . $this->applicationData['mother_phone'])
            ->line('هوية الأم: ' . $this->applicationData['mother_id'])
            ->line('اسم الأب: ' . $this->applicationData['father_name'])
            ->line('هاتف الأب: ' . $this->applicationData['father_phone'])
            ->line('هوية الأب: ' . $this->applicationData['father_id'])
            ->line('حضانة الطالب: ' . trans('options.'.$this->applicationData['custody']))
            ->line('الجنس: ' . trans('options.'. $this->applicationData['gender']))
            ->line('العنوان: ' . $this->applicationData['address'])
            ->line('شارع  ' . $this->applicationData['address_street'])
            ->line('رقم المنزل: ' . $this->applicationData['address_house_no'])
            ->line('الرمز البريدي (Zip): ' . $this->applicationData['zipcode'])
            ->line('رقم صندوق البريد: ' . $this->applicationData['postal_code'])
            ->line('أفراد الأسرة: ' . $this->applicationData['family_members'])
            ->action('عرض الطلب', route('students-request.show', $this->applicationData['id']))
            ->salutation('مع التحية');
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
