<?php

return [
    'cotcanxem' => [
        'name' => [
            'table' => 'users',
            'type' => 1,
            'name' => 'Account name',
        ],
        'email' => [
            'table' => 'users',
            'type' => 1,
            'name' => 'Email',
        ],
        'created_by' => [
            'table' => 'users',
            'type' => 0,
            'name' => 'Created by',
        ],
        'staff_id' => [
            'table' => 'users',
            'type' => 1,
            'name' => 'Person in charge',
        ],
        'status' => [
            'table' => 'users',
            'type' => 1,
            'name' => 'Account Status',
        ],
        'shares' => [
            'table' => 'users',
            'type' => 0,
            'name' => 'Staffs share',
        ],
        'created_at' => [
            'table' => 'users',
            'type' => 0,
            'name' => 'Created at',
        ],
        'updated_at' => [
            'table' => 'users',
            'type' => 0,
            'name' => 'Update at',
        ],


        'registered_date' => [
            'table' => 'infos',
            'type' => 1,
            'name' => 'Registered date',
        ],
        'agent_code' => [
            'table' => 'infos',
            'type' => 1,
            'name' => 'User code',
        ],
        'status_agent' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'User status',
        ],
        'country' => [
            'table' => 'infos',
            'type' => 1,
            'name' => 'Country',
        ],
        'city' => [
            'table' => 'infos',
            'type' => 1,
            'name' => 'City',
        ],
        'office' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Office',
        ],
        'tel_1' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Phone 1',
        ],
        'tel_2' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Phone 2',
        ],

        'fb' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Facebook',
        ],
        'gst' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'GST',
        ],
        'type_payment' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Type Payment',
        ],
        'website' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Website',
        ],
        'rating' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Rating',
        ],
        'contact_person' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Contact Person',
        ],
        'note' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Note',
        ],
        'type' => [
            'table' => 'infos',
            'type' => 0,
            'name' => 'Type',
        ],

        'position' => [
            'table' => 'people',
            'type' => 0,
            'name' => 'Position contact person',
        ],
        'phone' => [
            'table' => 'people',
            'type' => 0,
            'name' => 'Phone contact person',
        ],
        'birthday' => [
            'table' => 'people',
            'type' => 0,
            'name' => 'Birthday contact person',
        ],
        'email_contact' => [
            'table' => 'people',
            'type' => 0,
            'name' => 'Email contact person',
        ],
        'skype' => [
            'table' => 'people',
            'type' => 0,
            'name' => 'Skype contact person',
        ],
        'status_contact' => [
            'table' => 'people',
            'type' => 0,
            'name' => 'Status contact person',
        ],
        'ngaygoi' => [
            'table' => 'supports',
            'type' => 0,
            'name' => 'Date of call',
        ],
        'ngaygoilai' => [
            'table' => 'supports',
            'type' => 0,
            'name' => 'Date callback',
        ],
        'langoi' => [
            'table' => 'supports',
            'type' => 0,
            'name' => 'Last call',
        ],
        'admin_id' => [
            'table' => 'supports',
            'type' => 0,
            'name' => 'Caller',
        ],

        'noidung' => [
            'table' => 'supports',
            'type' => 0,
            'name' => 'Content',
        ],
    ],
    'remind_status' => [
        1=>[
            'name' => 'Pending'
        ],
        2=>[
            'name' => 'Extend'
        ],
        3=>[
            'name' => 'Not extend'
        ],
        4=>[
            'name' => 'Renewal'
        ],
        5=>[
            'name' => 'Not renewal'
        ],
    ]
];
