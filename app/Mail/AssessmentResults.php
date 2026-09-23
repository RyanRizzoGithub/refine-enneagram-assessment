<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssessmentResults extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $enneagramNumber;
    public $resultsUrl;

    /**
     * @param string $firstName        The recipient's first name.
     * @param string $enneagramNumber  The top Enneagram type number (1-9).
     * @param string $resultsUrl       Absolute URL to the recipient's results page.
     */
    public function __construct($firstName, $enneagramNumber, $resultsUrl)
    {
        $this->firstName = $firstName;
        $this->enneagramNumber = $enneagramNumber;
        $this->resultsUrl = $resultsUrl;
    }

    public function build()
    {
        return $this->subject('Here are your results')
                    ->view('emails.results');
    }
}
