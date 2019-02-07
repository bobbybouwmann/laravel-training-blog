<?php

namespace App\Mail;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewsLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Collection|Post[]
     */
    public $posts;

    /**
     * Create a new message instance.
     *
     * @param Collection $posts
     */
    public function __construct(Collection $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->markdown('emails.newsletter.weekly');
    }
}
