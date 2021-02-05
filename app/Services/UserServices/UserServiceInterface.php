<?php

namespace App\Services\UserServices;

use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Request;

interface UserServiceInterface
{
    public function paginateUser(int $recordNumber): LengthAwarePaginator;
    public function storeUser(string $userName, string $userMail, int $userPhone, UploadedFile $userPhoto): User;
    public function updateUser(string $userNameUpdated, string $userEmailUpdated, int $userPhoneUpdated, UploadedFile $userPhotoUpdated, int $userId): void;
    public function deleteUser(int $userId): void;
    public function verifyUserExist(int $userId): bool;
    public function storeUserCSV(): void;
    public function storeUserExcel(): void;
}
