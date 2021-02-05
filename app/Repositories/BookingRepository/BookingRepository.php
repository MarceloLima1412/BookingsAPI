<?php

namespace App\Repositories\BookingRepository;

use App\Booking;
use App\Repositories\Repository;

class BookingRepository extends Repository implements BookingRepositoryInterface
{
    protected $model;

    public function __construct(Booking $booking)
    {
        parent::__construct($booking);
    }

    public function paginateBookings(Int $numberOfBookingPerPage)
    {
        return $this->model::with('userrelation')->with('roomrelation')->paginate(
            $numberOfBookingPerPage
        );
    }

    public function createBooking(Int $userID, Int $roomId, String $date)
    {
        $bookingCreated = $this->model::create([
            'user' => $userID,
            'room' => $roomId,
            'date' => $date
        ]);

        return $bookingCreated;
    }


    public function updatedBooking(Array $bookingUpdated, Int $bookingId)
    {
        $this->model::find($bookingId)->update(
            $bookingUpdated
        );
    }

    public function deleteBooking(Int $bookingId)
    {
        $this->model::find($bookingId)->delete();
    }

    public function verifyBookingExist(Int $bookingId)
    {
        return $this->model::where('id', $bookingId)->exists();
    }

    public function deleteBookingByRoom(Int $roomId)
    {
        $this->model::where('room', $roomId)->delete();
    }

    public function deleteByUser(Int $userId)
    {
        $this->model::where('user', $userId)->delete();
    }
}
