<?php


namespace App\Services\BookingServices;


use Illuminate\Http\Request;

interface BookingServiceInterface
{
    public function paginateBookings(Int $numberOfBookingPerPage);
    public function createBooking(Int $userId, Int $roomId, String $date);
    public function updateBooking(Request $request, Int $bookingId);
    public function deleteBooking(Int $bookingId);
    public function deleteBookingByRoom(Int $roomId);
}
