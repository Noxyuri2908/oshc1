<?php

use Illuminate\Database\Seeder;

class InfoToUserClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$uniqueEmail = [];
        //$uniqueEmailHasReceiptInfo = [];
        //$peoples = \App\Admin\Person::whereNull('is_receive_comm')->whereNotNull('email')->get()->filter(function ($person) use (&$uniqueEmail){
        //    if (in_array($person->email,$uniqueEmail)) {
        //        return $person;
        //    }
        //    $uniqueEmail[] = $person->email;
        //})->map(function($person) {
        //    $person->delete();
        //});
        //$peoples = \App\Admin\Person::whereNotNull('email')->get()->filter(function ($person) use (&$uniqueEmailHasReceiptInfo){
        //    if (in_array($person->email,$uniqueEmailHasReceiptInfo) && empty($person->is_receive_comm)) {
        //        return $person;
        //    }
        //    $uniqueEmailHasReceiptInfo[] = $person->email;
        //})->map(function($person) {
        //    $person->delete();
        //});
        //$peoples = \App\Admin\Person::whereNull('is_receive_comm')->whereNotNull('email')->get()->filter(function ($person) use (&$uniqueEmail){
        //    if (in_array($person->email,$uniqueEmail)) {
        //        return $person;
        //    }
        //    $uniqueEmail[] = $person->email;
        //})->map(function($person) {
        //    $person->delete();
        //});
        $follows = \App\Admin\Follow::get();
        foreach($follows as $follow){
            $contact_id = $follow->contact_by;
            if(!is_array($contact_id)){
                \App\Admin\Follow::find($follow->id)->update([
                    'contact_by' => [
                        strval($contact_id)
                    ]
                ]);
            }
        }
    }
}

