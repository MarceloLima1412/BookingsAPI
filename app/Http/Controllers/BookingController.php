<?php

namespace App\Http\Controllers;

use App\Room;
use App\Services\BookingServices\BookingServiceInterface;
use App\User;
use App\Booking;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    private $bookingService;

    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {

        $validator = \Validator::make($request->all(),[
            'paginate' => 'required|int|min:1|max:15',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();

            return response()->json(
                $errors,
                Response::HTTP_BAD_REQUEST
            );
        }

        $numberOfBookingPerPage = $request->paginate;

        $bookings = $this->bookingService->paginateBookings($numberOfBookingPerPage);

        return response()->json(
            $bookings,
            Response::HTTP_OK
        );
    }

    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(),[
            'user' => 'required|numeric|min:1',
            'room' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();

            return response()->json(
            $errors,
            Response::HTTP_BAD_REQUEST
            );
        }

        $userId = $request->user;
        $roomId = $request->room;
        $date = $request->date;

        $booking = $this->bookingService->createBooking($userId,$roomId,$date);

        return response()->json(
            $booking,
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request, Int $bookingId)
    {

        $validator = \Validator::make($request->all(),[
            'user' => 'required|numeric|min:1',
            'room' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();

            return response()->json(
                $errors,
                Response::HTTP_BAD_REQUEST
            );
        }



        $booking = $this->bookingService->updateBooking($request, $bookingId);

        return response()->json($booking,200);
    }

    public function delete(Int $bookingId)
    {
        $bookingDeleted = $this->bookingService->deleteBooking($bookingId);

        return response()->json(
            $bookingDeleted,
            Response::HTTP_OK
        );
    }
}
