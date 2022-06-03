<?php

namespace App\Console\Commands;

use App\Imports\CommImport;
use App\Imports\CustomerImport;
use App\Imports\ImportAgentForCustomers;
use App\Imports\ProfitImport;
use App\Imports\UpdateComms;
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

    protected $table = '';


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
        $this->table = $this->argument('table');
        ini_set('memory_limit', '-1');
        $files = Storage::disk('data')->allFiles($this->table);
        foreach ($files as $key => $path){
            $this->import($path);
        }

    }

    public function import($path){
        try {
            switch ($this->table)
            {
                case 'customers':
                    Excel::import(new CustomerImport(), storage_path('app/data/'.$path));
                    break;
                case 'comms':
                    Excel::import(new CommImport(), storage_path('app/data/'.$path));
                    break;
                case 'profits':
                    Excel::import(new ProfitImport(), storage_path('app/data/'.$path));
                    break;
                case 'agents':
                    Excel::import(new ImportAgentForCustomers(), storage_path('app/data/'.$path));
                    break;
                case 'update_comms':
                    Excel::import(new UpdateComms(), storage_path('app/data/'.$path));
                    break;
                case 'update_status_cus':
                    Excel::import(new UpdateComms(), storage_path('app/data/'.$path));
                    break;
                default:
                    echo 'table not found';
                    break;
            }

        }catch (\Exception $exception){
            echo $exception->getMessage();
            echo $exception->getLine();
            print_r($exception->getTraceAsString());
            die();
        }
    }
}
