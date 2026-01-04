<?php

namespace App\Jobs;

use App\Services\WhatsappNotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsappNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $target;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param string $target
     * @param string $message
     */
    public function __construct(string $target, string $message)
    {
        $this->target = $target;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @param WhatsappNotificationService $service
     * @return void
     */
    public function handle(WhatsappNotificationService $service)
    {
        $service->send($this->target, $this->message);
    }
}
