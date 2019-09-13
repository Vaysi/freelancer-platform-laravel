<?php

namespace App\Notifications;

use App\Conversation;
use App\Project;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newMessage extends Notification
{
    use Queueable;
    public $project, $coversation , $from , $to;

    /**
     * Create a new notification instance.
     *
     * @param Project $project
     * @param Conversation $conversation
     * @param User $from
     * @param User $to
     */
    public function __construct(Project $project,Conversation $conversation,User $from,User $to)
    {
        $this->project = $project;
        $this->coversation = $conversation;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $greeting = sprintf('سلام %s !',$notifiable->name);
        $subject = sprintf('%s : شما یک پیام جدید از پروژه %s دارید','پروژستان' , $this->project->title);
        $link = ($this->project->user->id != $this->to->id) ? route('conversations.fte',['project'=>$this->project->id]) . '#msg' . $this->coversation->id : route('conversations.etf',['project'=>$this->project->id,'user'=>$this->from->id]) . '#msg' . $this->coversation->id;
        return (new MailMessage)
                    ->greeting($greeting)
                    ->subject($subject)
                    ->line(sprintf('شما پیامی جدید از پروژه %s دارید !',$project->title))
                    ->action('مشاهده پیام', $link)
                    ->line('با تشکر از شما');
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
