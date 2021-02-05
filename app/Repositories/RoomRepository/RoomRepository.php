<?php

namespace App\Repositories\RoomRepository;

use App\Repositories\Repository;
use App\Room;

class RoomRepository extends Repository implements RoomRepositoryInterface
{
    public $model;

    public function __construct(Room $room){
        parent::__construct($room);
    }

    public function paginateRoom($recordNumber)
    {

        $roomPaginate = $this->model::paginate(
            $recordNumber
        );

        return $roomPaginate;
    }

    public function createRoom($newRoomRoom, $newRoomType)
    {

        $roomCreated = $this->model::create([
        'room' => $newRoomRoom,
        'type' => $newRoomType,
        ]);

        return $roomCreated;
    }

    public function updateRoom($RoomUpdated, $roomId)
    {
        $room=$this->model::find($roomId)->update(
            $RoomUpdated
        );

        return $room;
    }

    public function deleteRoom($roomId)
    {
        $this->model::where('id', $roomId)->delete();
    }

   /* public function verifyRoomExist($roomId)
    {
        return $this->model::where('id', $roomId)->exists();
    }*/
}
