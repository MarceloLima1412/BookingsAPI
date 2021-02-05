<?php

namespace App\Http\Controllers;

use App\Services\RoomServices\RoomServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    private $roomService;

    public function __construct(RoomServiceInterface $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'paginate' => 'required|int|max:15|min:1'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();

            return response()->json(
                $errors,
                Response::HTTP_BAD_REQUEST
            );
        }

        $recordNumber = $request->paginate;

        $rooms = $this->roomService->paginateRooms($recordNumber);

        return response()->json(
            $rooms,
            Response::HTTP_OK
        );
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'room' => 'required|string',
            'type' => 'required|in:Single,Double'
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();

            return response()->json(
            $errors,
            Response::HTTP_BAD_REQUEST
            );
        }

        $newRoomRoom = $request->room ?? '';
        $newRoomType = $request->type ?? '';

        $roomCreated = $this->roomService->createRoom(
            $newRoomRoom,
            $newRoomType
        );

        return response()->json(
            $roomCreated,
            Response::HTTP_CREATED
        );
    }

    public function update(Int $roomId, Request $request)
    {

        $validator = \Validator::make($request->all(),[
            'room' => 'required|string',
            'type' => 'required|in:Single,Double'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();

            return response()->json(
                $errors,
                Response::HTTP_BAD_REQUEST
            );
        }

        $roomRoomUpdated = $request->room;
        $roomTypeUpdated = $request->type;

        $this->roomService->updateRoom(
            $roomRoomUpdated,
            $roomTypeUpdated,
            $roomId
        );

        return response()->json(
            'User updated with success',
            Response::HTTP_CREATED
        );
    }

    public function delete(Int $roomId)
    {
        $debug = true;
       $this->roomService->deleteRoom($roomId);

       return response()->json(
           null,
           Response::HTTP_OK
       );
    }


//Testes de arrays (não é sobre o projeto)
    public function test()
    {
        //Ir buscar ao usercontroller a funcao array
        //variavel user vai instaciar o user controller (user vai ser um objeto do tipo user controller)
        $array = new ArrayController();
        //usar a funçao array para obter o array
        //result guarda o resultado do getarray
        $result = $array->getarray();
        return response()->json($result[1]);
       // return response->json($user->getarray());
    }
}


