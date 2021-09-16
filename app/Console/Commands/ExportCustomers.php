<?php

namespace App\Console\Commands;

use App\Exports\CustomersExcel;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ExportCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:applies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        return Excel::store(new CustomersExcel(), 'data/exports/applies.xlsx');

    }
}
