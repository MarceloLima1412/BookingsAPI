<?php


namespace App\Services\RoomServices;


interface RoomServiceInterface
{
    public function paginateRooms(Int $recordNumber);
    public function createRoom(String $newRoomRoom, String $newRoomType);
    public function updateRoom(String $roomRoomUpdated, String $roomTypeUpdated, int $roomId);
    public function deleteRoom(Int $roomId);
    public function verifyRoomExist(Int $roomId);
}
