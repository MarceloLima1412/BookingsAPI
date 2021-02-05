<?php

namespace App\Http\Controllers;


use App\Services\UserServices\UserServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
      $this->userService = $userService;
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

       return response()->json(
           $this->userService->paginateUser($recordNumber),
           Response::HTTP_OK
       );
    }

    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|digits:9',
            'photo' => 'required|image'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();

                return response()->json(
                $errors,
                Response::HTTP_BAD_REQUEST
                );
            }

            $userName = $request->name;
            $userEmail = $request->email;
            $userPhone = $request->phone;
            $userPhoto = $request->photo;

        $usercreated = $this->userService->storeUser(
            $userName,
            $userEmail,
            $userPhone,
            $userPhoto
        );

        return response()->json(
            $usercreated,
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request, Int $userId){

        $validator = \Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|digits:9',
            'photo' => 'required|image'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();

            return response()->json(
                $errors,
                Response::HTTP_BAD_REQUEST
            );
        }

        $userNameUpdated = $request->name;
        $userEmailUpdated = $request->email;
        $userPhoneUpdated = $request->phone;
        $userPhotoUpdated = $request->photo;

        $this->userService->updateUser($userNameUpdated, $userEmailUpdated, $userPhoneUpdated, $userPhotoUpdated, $userId);

        return response()->json(
            'User Updated with success',
            Response::HTTP_CREATED
        );
    }

    public function delete(Int $id){

        $this->userService->deleteUser($id);

        return response()->json(
            null,
            Response::HTTP_OK
        );
    }



}
