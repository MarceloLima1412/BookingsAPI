<?php

namespace App\Jobs;

use App\Services\BookingServices\BookingService;
use App\Services\BookingServices\BookingServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Booking;

class QueueBookingService implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $action;
    private $payload;
    /**
     * @var
     */
    private $bookingService;

    /**
     * Create a new job instance.
     *
     * @param string $action
     * @param array $payload
     */
    public function __construct(string $action, array $payload)
    {
        $this->action = $action;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @param BookingServiceInterface $bookingService
     * @return void
     */
    public function handle(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
        switch ($this->action) {
            case 'deleteByRoom':
                $roomId = $this->payload['roomId'];
                $this->deleteByRoom($roomId);
                break;
            case 'deleteByUser':
                $userId = $this->payload['userId'];
                $this->deleteByUser($userId);
                break;
        }

    }

    private function deleteByRoom(int $roomId)
    {
        $this->bookingService->deleteBookingByRoom($roomId);
    }

    private function deleteByUser(int $userId)
    {
        $this->bookingService->deleteByUser($userId);
    }
}
