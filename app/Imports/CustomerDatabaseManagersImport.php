<?php

namespace App\Imports;

use App\CustomerDatabaseManager;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CustomerDatabaseManagersImport implements ToModel,WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $services = array_keys(\App\Admin\Service::pluck('name', 'id')->filter(function ($item) use ($row) {
            if (!empty($row[19])) {
                return false !== stristr(\Str::ascii($item), \Str::ascii($row[19]));
            }
        })->toArray());
        $genderType = array_keys(collect(\App\Admin\CustomerDatabaseManager::$GENDER)->filter(function ($item) use ($row) {
            if (!empty($row[7])) {
                return false !== stristr(\Str::ascii($item), \Str::ascii($row[7]));
            }
        })->toArray());
        $potentialityType = array_keys(collect(\App\Admin\CustomerDatabaseManager::$Potentiality)->filter(function ($item) use ($row) {
            if (!empty($row[18])) {
                return false !== stristr(\Str::ascii($item), \Str::ascii($row[18]));
            }
        })->toArray());
        $emailStatusType = array_keys(collect(\App\Admin\CustomerDatabaseManager::$EmailStatus)->filter(function ($item) use ($row) {
            if (!empty($row[20])) {
                return false !== stristr(\Str::ascii($item), \Str::ascii($row[20]));
            }
        })->toArray());
        $statuses = \App\Admin\Status::whereIn('type', [
            'customer_database_manager_type_of_customer',
            'customer_database_manager_resource',
            'customer_database_manager_english_center',
            'customer_database_manager_event',
            'customer_database_manager_study_tour'
        ])->get();
        $typeOfCustomer = $statuses->where('type', 'customer_database_manager_type_of_customer')->filter(function ($item) use ($row) {
            if (!empty($row[0])) {
                return false !== stristr(\Str::ascii($item->name), \Str::ascii($row[0]));

            }
        })->first();
        $resource = $statuses->where('type', 'customer_database_manager_resource')->filter(function ($item) use ($row) {
            if (!empty($row[2])) {
                return false !== stristr(\Str::ascii($item->name), \Str::ascii($row[2]));
            }
        })->first();

        $englishCenter = $statuses->where('type', 'customer_database_manager_english_center')->filter(function ($item) use ($row) {
            if (!empty($row[4])) {

                return false !== stristr(\Str::ascii($item->name), \Str::ascii($row[4]));
            }
        })->first();
        $event = $statuses->where('type', 'customer_database_manager_event')->filter(function ($item) use ($row) {
            if (!empty($row[5])) {
                return false !== stristr(\Str::ascii($item->name), \Str::ascii($row[5]));
            }
        })->first();
        $studyTour = $statuses->where('type', 'customer_database_manager_study_tour')->filter(function ($item) use ($row) {
            if (!empty($row[15])) {
                return false !== stristr(\Str::ascii($item->name), \Str::ascii($row[15]));
            }
        })->first();

        $agents = (!empty($row[3]))?\App\User::where('name', 'LIKE', '%' . $row[3] . '%')->first():null;

        $countries = collect(config('country.list'))->filter(function ($item) use ($row) {
            if(!empty($row[12])){
                return false !== stristr(\Str::ascii($item), \Str::ascii($row[12]));
            }
        })->toArray();

        $countryStudy = collect(config('country.list'))->filter(function ($item) use ($row) {
            if(!empty($row[17])){
                return false !== stristr(\Str::ascii($item), \Str::ascii($row[17]));
            }
        })->toArray();
        return new \App\Admin\CustomerDatabaseManager([
            'type_of_customer_id' => !empty($typeOfCustomer) ? $typeOfCustomer->id : null,
            'full_name' => (!empty($row[1]))?$row[1]:null,
            'source_id' => !empty($resource) ? $resource->id : null,
            'agent_id' => !empty($agents) ? $agents->id : null,
            'english_center_id' => !empty($englishCenter) ? $englishCenter->id : null,
            'event_id' => !empty($event) ? $event->id : null,
            'identification' => (!empty($row[6]))?$row[6]:null,
            'gender' => !empty($genderType) && !empty($genderType[0]) ? $genderType[0] : null,
            'date_of_birth' => (!empty($row[8]))?convert_date_to_db($row[8]):null,
            'mail' => (!empty($row[9]))?$row[9]:null,
            'phone_number' => (!empty($row[10]))?$row[10]:null,
            'social_link' => (!empty($row[11]))?$row[11]:null,
            'country_id' => !empty($countries) ?array_keys($countries)[0]:null,
            'city_name' => (!empty($row[13]))?$row[13]:null,
            'school_name' => (!empty($row[14]))?$row[14]:null,
            'study_tour' => !empty($studyTour) ?$studyTour->id:null,
            'departure_date' => (!empty($row[16]))?convert_date_to_db($row[16]):null,
            'destination_to_study' => !empty($countryStudy) ?array_keys($countryStudy)[0]:null,
            'potentiality' => !empty($potentialityType) ?$potentialityType[0]:null,
            'potential_service' => !empty($services) ?$services[0]:null,
            'email_status' => !empty($emailStatusType) ?$emailStatusType[0]:null,
            'note' => (!empty($row[21]))?$row[21]:null
        ]);
    }
}
