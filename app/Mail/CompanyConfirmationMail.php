<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompanyConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Company $company;

    /**
     * Create a new message instance.
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cégadatok regisztrálásának megerősítése',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.company_confirmation',
            with: [
                'company' => $this->company,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // return without attachment if company has no logo
        if (!$this->company->logo_image_path) {
            return [];
        }

        //get the full path to the logo image
        $logoPath = storage_path('app/public/' . $this->company->logo_image_path)?: null;

        // use pathinfo to get the extension
        $extension = pathinfo($logoPath, PATHINFO_EXTENSION);

        // add logo image as attachment
        return [
            Attachment::fromPath($logoPath)
                ->as($this->company->name . '_logo.' . $extension)
        ];
    }
}
