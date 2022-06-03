<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Writer;
use Matrix\Builder;
use Symfony\Component\HttpFoundation\File\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            "\App\Repositories\AgentRepo\AgentRepositoryInterface",
            "\App\Repositories\AgentRepo\AgentRepository"
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
            $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        });
        Writer::macro('setCreator', function (Writer $writer, string $creator) {
            $writer->getDelegate()->getProperties()->setCreator($creator);
        });
        Validator::extend('phone_number', function($attribute, $value, $parameters)
        {
            return substr($value, 0, 2) == '01';
        });
//        DB::listen(function($query) {
//            Log::info(
//                $query->sql,
//                $query->bindings,
//                $query->time
//            );
//        });
//        DB::listen(function($query) {
//            \Illuminate\Support\Facades\File::append(
//                storage_path('/logs/query.log'),
//                '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL . PHP_EOL
//            );
//        });
    }
}
