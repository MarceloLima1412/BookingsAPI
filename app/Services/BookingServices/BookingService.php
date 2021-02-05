<?php

namespace App\Services\BookingServices;

use App\Repositories\BookingRepository\BookingRepositoryInterface;
use App\Services\RoomServices\RoomService;
use App\Services\UserServices\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingService implements BookingServiceInterface
{
    private $bookingRepository;
    private $userService;
    private $roomService;

    public function __construct(BookingRepositoryInterface $bookingRepository, UserService $userService, RoomService $roomService)
    {
        $this->bookingRepository = $bookingRepository;
        $this->userService = $userService;
        $this->roomService = $roomService;
    }

    public function paginateBookings(Int $numberOfBookingPerPage)
    {
       return $this->bookingRepository->paginateBookings(
           $numberOfBookingPerPage
       );
    }

    public function createBooking(Int $userId, Int $roomId, String $date)
    {
        if(!$this->userService->verifyUserExist($userId)){
            return response()->json(
                'User dont exist',
                Response::HTTP_BAD_REQUEST
            );
        }

        if(!$this->roomService->verifyRoomExist($roomId)){
            return response()->json(
                'Room dont exist',
                Response::HTTP_BAD_REQUEST
            );
        }

        return $this->bookingRepository->createBooking(
            $userId,
            $roomId,
            $date
        );
    }


    public function updateBooking(Request $request, Int $bookingId)
    {
        $userUpdated = $request->user;
        $roomUpdated = $request->room;
        $dateUpdated = $request->date;

        if(!$this->userService->verifyUserExist($userUpdated)){
            return response()->json(
                'User dont exist',
                Response::HTTP_BAD_REQUEST
            );
        }

        if(!$this->roomService->verifyRoomExist($roomUpdated)){
            return response()->json(
                'Room dont exist',
                Response::HTTP_BAD_REQUEST
            );
        }

        $bookingUpdated = [
            'user' => $userUpdated,
            'room' => $roomUpdated,
            'date' => $dateUpdated
        ];

        return $this->bookingRepository->updatedBooking(
            $bookingUpdated,
            $bookingId
        );
    }

    public function deleteBooking(Int $bookingId)
    {
        if(!$this->bookingRepository->verifyBookingExist($bookingId)){
            return response()->json(
                'Booking dont exist',
                Response::HTTP_BAD_REQUEST
            );
        }

        $this->bookingRepository->deleteBooking(
            $bookingId
        );

        return response()->json(
            'Booking Eliminated',
            Response::HTTP_BAD_REQUEST
        );
    }

    public function deleteBookingByRoom(Int $roomId)
    {
        $this->bookingRepository->deleteBookingByRoom(
            $roomId
        );
    }

    public function deleteByUser(Int $userId)
    {
        $this->bookingRepository->deleteByUser($userId);
    }
}
