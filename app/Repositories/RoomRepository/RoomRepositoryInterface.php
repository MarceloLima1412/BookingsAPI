<?php

namespace App\Repositories\RoomRepository;


interface RoomRepositoryInterface
{
    public function paginateRoom($recordNumber);
    public function createRoom($newRoomRoom, $newRoomType);
    public function updateRoom($RoomUpdated, $roomId);
    public function deleteRoom($roomId);
   // public function verifyRoomExist($roomId);
}
