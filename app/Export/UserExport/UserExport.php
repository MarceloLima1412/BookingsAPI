<?php

namespace App\Export\UserExport;

use App\Enums\ExportChunkEnum;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;

class UserExport implements FromQuery, WithCustomChunkSize
{
    use Exportable;

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function query(): Builder
    {
        return $this->userRepository->getQuery();
    }

    public function chunkSize(): int
    {
        return ExportChunkEnum::USER_CHUNK_SIZE;
    }
}
