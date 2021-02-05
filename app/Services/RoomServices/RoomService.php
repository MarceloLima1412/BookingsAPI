<?php

namespace App\Services\RoomServices;

use App\Jobs\QueueBookingService;
use App\Repositories\RoomRepository\RoomRepositoryInterface;
use App\Services\BookingServices\BookingServiceInterface;

class RoomService implements RoomServiceInterface
{
    private $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function paginateRooms(Int $recordNumber){
        return $this->roomRepository->paginateRoom(
            $recordNumber
        );
    }

    public function createRoom(String $newRoomRoom, String $newRoomType)
    {
        return $this->roomRepository->createRoom(
            $newRoomRoom,
            $newRoomType
        );
    }

    public function updateRoom(String $roomRoomUpdated, String $roomTypeUpdated, int $roomId)
    {
        $RoomUpdated=[
            'room' => $roomRoomUpdated,
            'type' => $roomTypeUpdated,
        ];

        return $this->roomRepository->updateRoom(
            $RoomUpdated,
            $roomId
        );
    }

    public function deleteRoom(Int $roomId)
    {
        $this->roomRepository->deleteRoom(
            $roomId
        );

        $action = 'deleteByRoom';
        $payload = [
          'roomId' => $roomId
        ];

        QueueBookingService::dispatch($action, $payload);
    }

    public function verifyRoomExist(Int $roomId)
    {
        return $this->roomRepository->verifyRoomExist(
            $roomId
        );
    }
}
