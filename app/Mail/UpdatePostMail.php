<?php

namespace App\Mail;

use App\Listeners\SendUpdateMessage;
use App\Models\PostModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePostMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public PostModel $posts, public array $sendUpdateMessage)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('malubay.355325@davao.sti.edu.ph', 'Company ni Tristan'),
            subject: 'Post Updated',
        );
    }

    public function build()
    {
        $updated = implode(', ', $this->sendUpdateMessage);

        return $this->from('malubay.355325@davao.sti.edu.ph', 'Company ni Tristan')
            ->subject('Post Updated')
            ->html("<h1>Hi, your post {$this->posts->title} has been updated to {$updated}</h1>");
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     // return new Content(
    //     //     html: "<h1>Hi your post {$this->posts->title} has been updated!</p>",
    //     // );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
