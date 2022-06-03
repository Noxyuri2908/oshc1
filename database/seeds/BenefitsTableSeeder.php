<?php

use Illuminate\Database\Seeder;

class BenefitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('benefits')->delete();
        
        \DB::table('benefits')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Doctor Visits',
                'name_cn' => 'Doctor Visits',
                'name_vi' => 'Doctor Visits',
                'cat_benefit_id' => 4,
                'created_by' => 1,
                'pos' => 1,
                'status' => 1,
                'created_at' => '2019-07-31 03:23:28',
                'updated_at' => '2019-10-07 03:32:59',
            ),
            1 => 
            array (
                'id' => 2,
            'name' => 'Pathology (blood tests, X ray, scan)',
            'name_cn' => 'Pathology (blood tests, X ray, scan)',
            'name_vi' => 'Pathology (blood tests, X ray, scan)',
                'cat_benefit_id' => 4,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-19 08:12:39',
                'updated_at' => '2020-09-25 17:46:11',
            ),
            2 => 
            array (
                'id' => 3,
            'name' => 'Radiology (e.g. x-ray, scans)',
            'name_cn' => 'Radiology (e.g. x-ray, scans)',
            'name_vi' => 'Radiology (e.g. x-ray, scans)',
                'cat_benefit_id' => 4,
                'created_by' => 1,
                'pos' => 3,
                'status' => 0,
                'created_at' => '2019-08-19 08:13:10',
                'updated_at' => '2020-09-25 17:46:27',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Specialist consultations',
                'name_cn' => 'Specialist consultations',
                'name_vi' => 'Specialist consultations',
                'cat_benefit_id' => 4,
                'created_by' => 1,
                'pos' => 4,
                'status' => 1,
                'created_at' => '2019-08-19 08:13:36',
                'updated_at' => '2019-10-07 03:34:49',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Amblulance services',
                'name_cn' => 'Amblulance服务',
                'name_vi' => 'Dịch vụ cấp cứu',
                'cat_benefit_id' => 2,
                'created_by' => 1,
                'pos' => NULL,
                'status' => 1,
                'created_at' => '2019-08-19 08:14:09',
                'updated_at' => '2019-08-19 08:14:09',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Surgically implanted prostheses',
                'name_cn' => '手术植入假肢',
                'name_vi' => 'Phẫu thuật cấy ghép chân giả',
                'cat_benefit_id' => 2,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-19 08:14:37',
                'updated_at' => '2019-08-19 08:14:37',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'MRI\'s',
                'name_cn' => 'MRI\'s',
                'name_vi' => 'MRI\'s',
                'cat_benefit_id' => 2,
                'created_by' => 1,
                'pos' => 3,
                'status' => 0,
                'created_at' => '2019-08-19 08:14:54',
                'updated_at' => '2020-09-25 18:01:34',
            ),
            7 => 
            array (
                'id' => 8,
            'name' => 'Visa Compliance (Meets government requirements)',
            'name_cn' => 'Visa Compliance (Meets government requirements)',
            'name_vi' => 'Visa Compliance (Meets government requirements)',
                'cat_benefit_id' => 3,
                'created_by' => 1,
                'pos' => NULL,
                'status' => 1,
                'created_at' => '2019-08-29 09:37:21',
                'updated_at' => '2019-08-29 09:37:21',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Public Hospital',
                'name_cn' => 'Public Hospital',
                'name_vi' => 'Public Hospital',
                'cat_benefit_id' => 1,
                'created_by' => 1,
                'pos' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 03:35:25',
                'updated_at' => '2019-10-07 03:35:25',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Private Hospital',
                'name_cn' => 'Private Hospital',
                'name_vi' => 'Private Hospital',
                'cat_benefit_id' => 1,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-10-07 03:35:59',
                'updated_at' => '2019-10-07 03:35:59',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Private Room',
                'name_cn' => 'Private Room',
                'name_vi' => 'Private Room',
                'cat_benefit_id' => 1,
                'created_by' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2019-10-07 03:39:37',
                'updated_at' => '2019-10-07 03:41:33',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Prescription medicines ',
                'name_cn' => 'Prescription medicines ',
                'name_vi' => 'Prescription medicines ',
                'cat_benefit_id' => 2,
                'created_by' => 1,
                'pos' => 4,
                'status' => 0,
                'created_at' => '2019-10-07 03:42:34',
                'updated_at' => '2020-09-25 18:02:04',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Prescription medicine co-payment',
                'name_cn' => 'Prescription medicine co-payment',
                'name_vi' => 'Prescription medicine co-payment',
                'cat_benefit_id' => 2,
                'created_by' => 1,
                'pos' => 5,
                'status' => 0,
                'created_at' => '2019-10-07 03:42:54',
                'updated_at' => '2020-09-25 18:02:38',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Psychiatric Conditions',
                'name_cn' => 'Psychiatric Conditions',
                'name_vi' => 'Psychiatric Conditions',
                'cat_benefit_id' => 5,
                'created_by' => 1,
                'pos' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 03:43:41',
                'updated_at' => '2019-10-07 03:43:41',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Pregnancy and birth related services',
                'name_cn' => 'Pregnancy and birth related services',
                'name_vi' => 'Pregnancy and birth related services',
                'cat_benefit_id' => 5,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-10-07 03:45:26',
                'updated_at' => '2019-10-07 03:45:26',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Other pre-exisiting conditions',
                'name_cn' => 'Other pre-exisiting conditions',
                'name_vi' => 'Other pre-exisiting conditions',
                'cat_benefit_id' => 5,
                'created_by' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2019-10-07 03:45:44',
                'updated_at' => '2019-10-07 03:45:44',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Refund Policy',
                'name_cn' => 'Refund Policy',
                'name_vi' => 'Refund Policy',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => 1,
                'status' => 0,
                'created_at' => '2019-10-07 03:46:04',
                'updated_at' => '2020-09-25 18:22:55',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Support Services',
                'name_cn' => 'Support Services',
                'name_vi' => 'Support Services',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => 2,
                'status' => 0,
                'created_at' => '2019-10-07 03:46:19',
                'updated_at' => '2020-09-25 18:23:50',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => '24*7 support with interpreter service',
                'name_cn' => '24*7 support with interpreter service',
                'name_vi' => '24*7 support with interpreter service',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => 7,
                'status' => 1,
                'created_at' => '2019-10-07 03:46:43',
                'updated_at' => '2020-09-25 18:21:59',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Mobile App',
                'name_cn' => 'Mobile App',
                'name_vi' => 'Mobile App',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => 4,
                'status' => 1,
                'created_at' => '2019-10-07 03:47:00',
                'updated_at' => '2019-10-07 03:47:00',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Emergency support App mobile',
                'name_cn' => 'Emergency support App mobile',
                'name_vi' => 'Emergency support App mobile',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => 5,
                'status' => 1,
                'created_at' => '2019-10-07 03:47:15',
                'updated_at' => '2019-10-07 03:47:15',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Video doctor',
                'name_cn' => 'Video doctor',
                'name_vi' => 'Video doctor',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2019-10-07 03:47:31',
                'updated_at' => '2020-09-25 18:15:27',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Pregnancy and birth related services',
                'name_cn' => 'Pregnancy and birth related services',
                'name_vi' => 'Pregnancy and birth related services',
                'cat_benefit_id' => 1,
                'created_by' => 1,
                'pos' => 5,
                'status' => 1,
                'created_at' => '2020-09-25 17:45:03',
                'updated_at' => '2020-09-25 17:45:03',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Direct Billing Network',
                'name_cn' => 'Direct Billing Network',
                'name_vi' => 'Direct Billing Network',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => NULL,
                'status' => 1,
                'created_at' => '2020-09-25 18:04:52',
                'updated_at' => '2020-09-25 18:04:52',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Representative Offices in Schools, Institution',
                'name_cn' => 'Representative Offices in Schools, Institution',
                'name_vi' => 'Representative Offices in Schools, Institution',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2020-09-25 18:05:33',
                'updated_at' => '2020-09-25 18:05:33',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'National home doctor',
                'name_cn' => 'National home doctor',
                'name_vi' => 'National home doctor',
                'cat_benefit_id' => 6,
                'created_by' => 1,
                'pos' => 4,
                'status' => 1,
                'created_at' => '2020-09-25 18:15:58',
                'updated_at' => '2020-09-25 18:15:58',
            ),
        ));
        
        
    }
}