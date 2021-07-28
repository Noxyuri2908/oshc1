<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CustomerDatabaseManager extends Model
{
    //
    protected $table = 'customer_database_manager';
    protected $fillable = [
        'type_of_customer_id',
        'full_name',
        'source_id',
        'agent_id',
        'english_center_id',
        'event_id',
        'identification',
        'gender',
        'date_of_birth',
        'mail',
        'phone_number',
        'fb',
        'social_link',
        'country_id',
        'city_name',
        'school_name',
        'study_tour',
        'departure_date',
        'destination_to_study',
        'potentiality',
        'potential_service',
        'email_status',
        'note'
    ];
    public static $GENDER = [
        1=>'Male',
        2=>'Female'
    ];
    public static $Potentiality= [
        1=>'A',
        2=>'B',
        3=>'C'
    ];
    public static $EmailStatus=[
        1=>'Active',
        2=>'InActive'
    ];
}
