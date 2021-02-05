<?php

namespace App\Services\UserServices;

use App\Export\UserExport\UserExport;
use App\Jobs\QueueBookingService;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function paginateUser(int $recordNumber): LengthAwarePaginator
    {
        return $this->userRepository->paginateUser($recordNumber);
    }

    public function storeUser(string $userName, string $userMail, int $userPhone, UploadedFile $userPhoto): User
    {
        $photoName = $userName . '_' . time() . '.' . $userPhoto->getClientOriginalExtension();

        Storage::putFileAs(
            'public\photos',
            $userPhoto,
            $photoName
        );

        $userPassword = bcrypt('password');

        return $this->userRepository->storeUser(
            $userName,
            $userPassword,
            $userMail,
            $userPhone,
            $photoName
        );
    }

    public function updateUser(string $userNameUpdated, string $userEmailUpdated, int $userPhoneUpdated, UploadedFile $userPhotoUpdated, int $userId): void
    {
        $userOld=$this->userRepository->getUserById(
            $userId
        );

        $userPhotoName = $userOld->name . '_' . time() . '.' . $userPhotoUpdated->getClientOriginalExtension();

        if (Storage::disk("public")->exists("photos/".$userOld->photo)) {
            Storage::disk("public")->delete("photos/".$userOld->photo);
        }

        Storage::putFileAs(
            'public\photos',
            $userPhotoUpdated,
            $userPhotoName
        );

        $userPhotoUpdated = $userPhotoName;

        $userUpdated = [
            'name' => $userNameUpdated,
            'email' => $userEmailUpdated,
            'phone' => $userPhoneUpdated,
            'photo' => $userPhotoUpdated,
        ];

         $this->userRepository->updateUser(
            $userId,
            $userUpdated
        );
    }

    public function deleteUser(int $userId): void
    {
        $user=$this->userRepository->getUserById(
            $userId
        );

        if (Storage::disk("public")->exists("photos/".$user->photo)) {
            Storage::disk("public")->delete("photos/".$user->photo);
        }

        $this->userRepository->deleteUser($userId);

        $action = 'deleteByUser';
        $payload = [
            'userId' => $userId
        ];

        QueueBookingService::dispatch($action, $payload);
    }

    public function verifyUserExist(int $userId): bool
    {
        return $this->userRepository->verifyUserExist($userId);
    }

    public function getLastOffset(): int
    {
        return $this->userRepository->countUsers() - 2;
    }

    public function storeUserCSV(): void
    {
        $columns = ['name', 'email', 'phone'];

        $lastOffset = $this->getlastOffset();

        $file = fopen("/var/www/storage/usersExports.csv", 'w');

        fputcsv($file, $columns);

        fclose($file);

        for ($offsetNumber = 0; $offsetNumber <= $lastOffset; $offsetNumber++) {
            $usersToExport = $this->userRepository->getChunkResult($offsetNumber);

            if(empty($usersToExport)) {
                continue;
            }

            $file = fopen("/var/www/storage/app/public/usersExports.csv", 'a');

            foreach ($usersToExport as $user) {
                $row['name'] = $user->name;
                $row['email'] = $user->email;
                $row['phone'] = $user->phone;

                fputcsv($file, [$row['name'], $row['email'], $row['phone']]);
            }

            fclose($file);

            $offsetNumber++;
        }
    }

    public function storeUserExcel(): void
    {
        (new UserExport($this->userRepository))->store('usersExports.xlsx');
    }

}
