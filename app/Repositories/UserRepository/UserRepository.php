<?php

namespace App\Repositories\UserRepository;

use App\Repositories\Repository;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends Repository implements UserRepositoryInterface
{
    const LIMIT = 2;

    protected $model;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function paginateUser(int $recordNumber): LengthAwarePaginator
    {
        return $this->model::paginate($recordNumber);
    }

    public function storeUser(string $userName, string $userPassword, string $userEmail, int $userPhone, string $photoName): User
    {
        return $this->model::create([
            'name'=> $userName,
            'password' => $userPassword,
            'email'=> $userEmail,
            'phone'=> $userPhone,
            'photo'=> $photoName
            ]
        );
    }

    public function updateUser(int $userId, array $userUpdated): void
    {
        $this->model::find($userId)
            ->update($userUpdated);
    }

    public function deleteUser(int $userId): void
    {
        $this->model::find($userId)
            ->delete();
    }

    public function getUserById(int $userId): User
    {
        return $this->model::find($userId);
    }

    public function verifyUserExist(int $userId): bool
    {
        return $this->model::where('id', $userId)
            ->exists();
    }

    public function countUsers(): int
    {
        return $this->model::get()
            ->count();
    }

    public function getChunkResult(int $offsetNumber): Collection
    {
        return $this->model::limit(self::LIMIT)
            ->offset($offsetNumber)
            ->get();
    }

    public function getQuery(): Builder
    {
        return $this->model::query();
    }
}
