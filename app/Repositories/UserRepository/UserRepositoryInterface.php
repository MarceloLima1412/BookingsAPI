<?php

namespace App\Repositories\UserRepository;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function storeUser(string $userName, string $userPassword, string $userEmail, int $userPhone, string $photoName): User;
    public function paginateUser(int $recordNumber): LengthAwarePaginator;
    public function updateUser(int $userId, array $userUpdated): void;
    public function deleteUser(int $userId): void;
    public function getUserById(int $userId): User;
    public function verifyUserExist(int $userId): bool;
    public function getChunkResult(int $offsetNumber): Collection;
    public function countUsers(): int;
    public function getQuery(): Builder;
}
