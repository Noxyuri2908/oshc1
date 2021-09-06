<?php

namespace App\Console\Commands;

use App\Imports\CustomerImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:seed {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data customers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $files = Storage::disk('data')->allFiles($this->argument('table'));
        foreach ($files as $key => $path){
            $this->import($path);
        }

    }

    public function import($path){
        try {
            Excel::import(new CustomerImport(), storage_path('app/data/'.$path));
            return 'Done!';

        }catch (\Exception $exception){
            echo $exception->getMessage();
            die();
        }
    }
}
