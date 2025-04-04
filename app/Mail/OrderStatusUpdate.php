<?php

namespace App\Mail;

use App\Models\OrderInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\OrderInfo
     */
    public $order;
    
    /**
     * The previous status.
     *
     * @var string
     */
    public $previousStatus;

    /**
     * Create a new message instance.
     */
    public function __construct(OrderInfo $order, string $previousStatus)
    {
        $this->order = $order;
        $this->previousStatus = $previousStatus;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order #' . $this->order->id . ' Status Update',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-status-update',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = PDF::loadView('emails.order-receipt', ['order' => $this->order]);
        
        return [
            Attachment::fromData(fn () => $pdf->output(), 'receipt.pdf')
                ->withMime('application/pdf'),
        ];
    }
}

