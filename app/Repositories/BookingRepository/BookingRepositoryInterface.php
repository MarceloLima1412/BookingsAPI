<?php


namespace App\Repositories\BookingRepository;


interface BookingRepositoryInterface
{
    public function paginateBookings(Int $numberOfBookingPerPage);
    public function createBooking(Int $userID, Int $roomId, String $date);
    public function updatedBooking(Array $bookingUpdated, Int $bookingId);
    public function deleteBooking(Int $bookingId);
    public function verifyBookingExist(Int $bookingId);
    public function deleteBookingByRoom(Int $roomId);
    public function deleteByUser(Int $userId);
}
