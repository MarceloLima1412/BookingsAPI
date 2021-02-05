<?php

namespace App\Console\Commands;

use App\Services\UserServices\UserService;
use App\Services\UserServices\UserServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ExportUsers extends Command
{
    private $userService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:export {type : CSV or Excel}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all users';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param UserServiceInterface $userService
     * @return int
     */
    public function handle(UserServiceInterface  $userService)
    {
        $this->userService = $userService;
        $parameterReceived = $this->argument('type');
        if($parameterReceived == 'CSV')
        {
            $this->userService->storeUserCSV();
            if(Storage::disk("public")->exists('usersExports.csv')){
            $this->line('CSV created with success');
            }else{
                $this->line('Error in CSV creation');
            }
        }elseif($parameterReceived == 'Excel')
        {
            $this->userService->storeUserExcel();
            if(Storage::disk("public")->exists('usersExports.xlsx')){
                $this->line('Excel created with success');
            }else{
                $this->line('Error in Excel creation');
            }
        }else{
            $this->line('Error: Invalid option. Check -h for more information');
        }
    }


}
