<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('statuses')->delete();

        \DB::table('statuses')->insert(array (
            0 =>
            array (
                'id' => 2,
                'name' => 'Copy',
                'type' => 'type_source_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'value' => NULL,
            ),
            1 =>
            array (
                'id' => 3,
                'name' => 'Dich',
                'type' => 'type_source_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'value' => NULL,
            ),
            2 =>
            array (
                'id' => 4,
                'name' => 'Edit',
                'type' => 'type_source_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'value' => NULL,
            ),
            3 =>
            array (
                'id' => 5,
                'name' => 'Viết sống',
                'type' => 'type_source_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'value' => NULL,
            ),
            4 =>
            array (
                'id' => 6,
                'name' => 'PR',
                'type' => 'type_source_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'value' => NULL,
            ),
            5 =>
            array (
                'id' => 7,
                'name' => 'abc',
                'type' => 'category_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-18 21:00:25',
                'updated_at' => '2020-11-18 21:00:25',
                'value' => NULL,
            ),
            6 =>
            array (
                'id' => 8,
                'name' => 'Web SSDH',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-19 15:43:33',
                'updated_at' => '2020-11-19 18:30:20',
                'value' => '["K\\u1ebft n\\u1ed1i du h\\u1ecdc","H\\u1ecdc b\\u1ed5ng du h\\u1ecdc","Tin t\\u1ee9c","English Help","Hello ng\\u00e0y m\\u1edbi","H\\u00f3ng"]',
            ),
            7 =>
            array (
                'id' => 9,
                'name' => 'Web OSHCstudents',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-19 15:43:47',
                'updated_at' => '2020-11-19 15:43:47',
                'value' => NULL,
            ),
            8 =>
            array (
                'id' => 10,
                'name' => 'Web Annalink',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-19 15:43:56',
                'updated_at' => '2020-11-19 15:43:56',
                'value' => NULL,
            ),
            9 =>
            array (
                'id' => 11,
                'name' => 'Web OSHC',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-19 15:44:04',
                'updated_at' => '2020-11-19 15:44:04',
                'value' => NULL,
            ),
            10 =>
            array (
                'id' => 12,
                'name' => 'Web OVHC',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-19 15:44:11',
                'updated_at' => '2020-11-19 15:44:11',
                'value' => NULL,
            ),
            11 =>
            array (
                'id' => 13,
                'name' => 'Web Edupay',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-19 15:44:21',
                'updated_at' => '2020-11-19 15:44:21',
                'value' => NULL,
            ),
            12 =>
            array (
                'id' => 14,
                'name' => 'Web CBH',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-19 15:44:31',
                'updated_at' => '2020-11-19 15:44:31',
                'value' => NULL,
            ),
            13 =>
            array (
                'id' => 15,
                'name' => 'Web annalinktour',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-19 15:44:38',
                'updated_at' => '2020-11-19 15:44:38',
                'value' => NULL,
            ),
            14 =>
            array (
                'id' => 16,
                'name' => 'Báo online',
                'type' => 'from_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-24 21:15:25',
                'updated_at' => '2020-11-24 21:15:25',
                'value' => NULL,
            ),
            15 =>
            array (
                'id' => 17,
                'name' => 'web provider',
                'type' => 'from_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-24 21:20:13',
                'updated_at' => '2020-11-24 21:20:13',
                'value' => NULL,
            ),
            16 =>
            array (
                'id' => 18,
                'name' => 'Personal facebook account',
                'type' => 'type_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-24 21:31:43',
                'updated_at' => '2020-11-24 21:31:43',
                'value' => NULL,
            ),
            17 =>
            array (
                'id' => 19,
                'name' => 'User',
                'type' => 'type_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-24 21:32:01',
                'updated_at' => '2020-11-24 21:32:01',
                'value' => NULL,
            ),
            18 =>
            array (
                'id' => 20,
                'name' => 'Breaking hot news',
                'type' => 'information_focused_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-24 21:32:15',
                'updated_at' => '2020-11-24 21:32:15',
                'value' => NULL,
            ),
            19 =>
            array (
                'id' => 21,
                'name' => 'Scholarship',
                'type' => 'information_focused_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-24 21:32:27',
                'updated_at' => '2020-11-24 21:32:27',
                'value' => NULL,
            ),
            20 =>
            array (
                'id' => 22,
                'name' => 'Sẵn sàng du học',
                'type' => 'web_media_content',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-25 21:04:50',
                'updated_at' => '2021-01-04 21:11:52',
                'value' => '["C\\u1ea8M NANG DU H\\u1eccC","G\\u00d3C NH\\u00ccN DU H\\u1eccC","TR\\u1ea2I NGHI\\u1ec6M DU H\\u1eccC","K\\u1ebeT N\\u1ed0I DU H\\u1eccC"]',
            ),
            21 =>
            array (
                'id' => 23,
                'name' => 'Group',
                'type' => 'source_post_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-25 21:29:31',
                'updated_at' => '2021-01-05 19:45:33',
                'value' => NULL,
            ),
            22 =>
            array (
                'id' => 24,
                'name' => 'SSDH',
                'type' => 'group_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-26 18:05:46',
                'updated_at' => '2021-01-07 21:47:34',
                'value' => '["abcbc"]',
            ),
            23 =>
            array (
                'id' => 25,
                'name' => 'Website',
                'type' => 'category_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-26 18:17:00',
                'updated_at' => '2020-11-26 18:17:00',
                'value' => NULL,
            ),
            24 =>
            array (
                'id' => 26,
                'name' => 'Facebook',
                'type' => 'category_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-26 18:17:13',
                'updated_at' => '2020-11-26 18:17:13',
                'value' => NULL,
            ),
            25 =>
            array (
                'id' => 27,
                'name' => 'Group',
                'type' => 'category_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-26 18:17:22',
                'updated_at' => '2020-11-26 18:17:22',
                'value' => NULL,
            ),
            26 =>
            array (
                'id' => 28,
                'name' => 'Blog',
                'type' => 'category_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-11-26 18:17:41',
                'updated_at' => '2020-11-26 18:17:41',
                'value' => NULL,
            ),
            27 =>
            array (
                'id' => 30,
                'name' => 'Domain',
                'type' => 'type_domain_hosting',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-08 17:44:31',
                'updated_at' => '2020-12-08 17:44:31',
                'value' => NULL,
            ),
            28 =>
            array (
                'id' => 31,
                'name' => 'Host',
                'type' => 'type_domain_hosting',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-08 17:44:41',
                'updated_at' => '2020-12-08 17:44:41',
                'value' => NULL,
            ),
            29 =>
            array (
                'id' => 32,
                'name' => 'Server',
                'type' => 'type_domain_hosting',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-08 17:44:49',
                'updated_at' => '2020-12-08 17:44:49',
                'value' => NULL,
            ),
            30 =>
            array (
                'id' => 33,
                'name' => 'Backup server',
                'type' => 'type_domain_hosting',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-08 17:44:54',
                'updated_at' => '2020-12-08 17:44:54',
                'value' => NULL,
            ),
            31 =>
            array (
                'id' => 34,
                'name' => 'Support',
                'type' => 'type_domain_hosting',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-08 17:44:59',
                'updated_at' => '2020-12-08 17:44:59',
                'value' => NULL,
            ),
            32 =>
            array (
                'id' => 35,
                'name' => 'Brandings',
                'type' => 'category_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:19:07',
                'updated_at' => '2020-12-11 14:19:07',
                'value' => NULL,
            ),
            33 =>
            array (
                'id' => 36,
                'name' => 'Brochure',
                'type' => 'category_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:19:16',
                'updated_at' => '2020-12-11 14:19:16',
                'value' => NULL,
            ),
            34 =>
            array (
                'id' => 37,
                'name' => 'Handbook',
                'type' => 'category_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:19:24',
                'updated_at' => '2020-12-11 14:19:24',
                'value' => NULL,
            ),
            35 =>
            array (
                'id' => 38,
                'name' => 'Partner',
                'type' => 'use_for_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:19:31',
                'updated_at' => '2020-12-11 14:19:31',
                'value' => NULL,
            ),
            36 =>
            array (
                'id' => 39,
                'name' => 'Onshore User',
                'type' => 'use_for_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:19:37',
                'updated_at' => '2020-12-11 14:19:37',
                'value' => NULL,
            ),
            37 =>
            array (
                'id' => 40,
                'name' => 'Offshore User',
                'type' => 'use_for_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:19:43',
                'updated_at' => '2020-12-11 14:19:43',
                'value' => NULL,
            ),
            38 =>
            array (
                'id' => 41,
                'name' => 'Brandings',
                'type' => 'target_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:19:58',
                'updated_at' => '2020-12-11 14:19:58',
                'value' => NULL,
            ),
            39 =>
            array (
                'id' => 42,
                'name' => 'Sales',
                'type' => 'target_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:20:06',
                'updated_at' => '2020-12-11 14:21:00',
                'value' => '["Profile","Proposal","Private proposal","Training slide","User Guide"]',
            ),
            40 =>
            array (
                'id' => 43,
                'name' => 'Event',
                'type' => 'target_marketing_material',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 14:20:11',
                'updated_at' => '2020-12-11 14:54:20',
                'value' => NULL,
            ),
            41 =>
            array (
                'id' => 44,
                'name' => 'Web ACCI Center',
                'type' => 'web_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-11 18:49:43',
                'updated_at' => '2020-12-11 18:49:43',
                'value' => NULL,
            ),
            42 =>
            array (
                'id' => 45,
                'name' => 'Director',
                'type' => 'department_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:57:36',
                'updated_at' => '2020-12-22 20:57:36',
                'value' => NULL,
            ),
            43 =>
            array (
                'id' => 46,
                'name' => 'Business',
                'type' => 'department_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:57:41',
                'updated_at' => '2020-12-22 20:57:41',
                'value' => NULL,
            ),
            44 =>
            array (
                'id' => 47,
                'name' => 'Accounting',
                'type' => 'department_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:57:47',
                'updated_at' => '2020-12-22 20:57:47',
                'value' => NULL,
            ),
            45 =>
            array (
                'id' => 48,
                'name' => 'Marketing',
                'type' => 'department_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:57:52',
                'updated_at' => '2020-12-22 20:57:52',
                'value' => NULL,
            ),
            46 =>
            array (
                'id' => 49,
                'name' => 'IT',
                'type' => 'department_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:57:57',
                'updated_at' => '2020-12-22 20:57:57',
                'value' => NULL,
            ),
            47 =>
            array (
                'id' => 50,
                'name' => 'Director',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:58:16',
                'updated_at' => '2020-12-22 20:58:16',
                'value' => NULL,
            ),
            48 =>
            array (
                'id' => 51,
                'name' => 'Vice director',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:58:21',
                'updated_at' => '2020-12-22 20:58:21',
                'value' => NULL,
            ),
            49 =>
            array (
                'id' => 52,
                'name' => 'Marketing manager',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:58:26',
                'updated_at' => '2020-12-22 20:58:26',
                'value' => NULL,
            ),
            50 =>
            array (
                'id' => 53,
                'name' => 'Accountant manager',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:58:32',
                'updated_at' => '2020-12-22 20:58:32',
                'value' => NULL,
            ),
            51 =>
            array (
                'id' => 54,
                'name' => 'Business manager',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:58:38',
                'updated_at' => '2020-12-22 20:58:38',
                'value' => NULL,
            ),
            52 =>
            array (
                'id' => 55,
                'name' => 'Marketing executive',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:58:44',
                'updated_at' => '2020-12-22 20:58:44',
                'value' => NULL,
            ),
            53 =>
            array (
                'id' => 56,
                'name' => 'Accountant',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:58:50',
                'updated_at' => '2020-12-22 20:58:50',
                'value' => NULL,
            ),
            54 =>
            array (
                'id' => 57,
                'name' => 'Media manager',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:58:57',
                'updated_at' => '2020-12-22 20:58:57',
                'value' => NULL,
            ),
            55 =>
            array (
                'id' => 58,
                'name' => 'Media executive',
                'type' => 'position_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:59:03',
                'updated_at' => '2020-12-22 20:59:03',
                'value' => NULL,
            ),
            56 =>
            array (
                'id' => 59,
                'name' => 'Hanoi',
                'type' => 'branch_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:59:20',
                'updated_at' => '2020-12-22 20:59:20',
                'value' => NULL,
            ),
            57 =>
            array (
                'id' => 60,
                'name' => 'Hochiminh',
                'type' => 'branch_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:59:26',
                'updated_at' => '2020-12-22 20:59:26',
                'value' => NULL,
            ),
            58 =>
            array (
                'id' => 61,
                'name' => 'Sydney',
                'type' => 'branch_staff',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-22 20:59:33',
                'updated_at' => '2020-12-22 20:59:33',
                'value' => NULL,
            ),
            59 =>
            array (
                'id' => 62,
                'name' => 'Học sinh',
                'type' => 'customer_database_manager_type_of_customer',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:52:50',
                'updated_at' => '2020-12-24 19:52:50',
                'value' => NULL,
            ),
            60 =>
            array (
                'id' => 63,
                'name' => 'Phụ huynh',
                'type' => 'customer_database_manager_type_of_customer',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:52:57',
                'updated_at' => '2020-12-24 19:52:57',
                'value' => NULL,
            ),
            61 =>
            array (
                'id' => 64,
                'name' => 'Other',
                'type' => 'customer_database_manager_type_of_customer',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:53:03',
                'updated_at' => '2020-12-24 19:53:03',
                'value' => NULL,
            ),
            62 =>
            array (
                'id' => 65,
                'name' => 'User',
                'type' => 'customer_database_manager_resource',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:53:17',
                'updated_at' => '2020-12-24 19:53:17',
                'value' => NULL,
            ),
            63 =>
            array (
                'id' => 66,
                'name' => 'TTTA',
                'type' => 'customer_database_manager_resource',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:53:22',
                'updated_at' => '2020-12-24 19:53:22',
                'value' => NULL,
            ),
            64 =>
            array (
                'id' => 67,
                'name' => 'THPT',
                'type' => 'customer_database_manager_resource',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:53:27',
                'updated_at' => '2020-12-24 19:53:27',
                'value' => NULL,
            ),
            65 =>
            array (
                'id' => 68,
                'name' => 'CRM OSHC',
                'type' => 'customer_database_manager_resource',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:53:31',
                'updated_at' => '2020-12-24 19:53:31',
                'value' => NULL,
            ),
            66 =>
            array (
                'id' => 69,
                'name' => 'CRM Homestay',
                'type' => 'customer_database_manager_resource',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:53:36',
                'updated_at' => '2020-12-24 19:53:36',
                'value' => NULL,
            ),
            67 =>
            array (
                'id' => 70,
                'name' => 'Fanpage OSHC',
                'type' => 'customer_database_manager_resource',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:53:42',
                'updated_at' => '2020-12-24 19:53:42',
                'value' => NULL,
            ),
            68 =>
            array (
                'id' => 71,
                'name' => 'Fanpage SSDH',
                'type' => 'customer_database_manager_resource',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:53:48',
                'updated_at' => '2020-12-24 19:53:48',
                'value' => NULL,
            ),
            69 =>
            array (
                'id' => 72,
                'name' => 'Chọn trung tâm anh ngữ',
                'type' => 'customer_database_manager_english_center',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:54:09',
                'updated_at' => '2020-12-24 19:54:09',
                'value' => NULL,
            ),
            70 =>
            array (
                'id' => 73,
                'name' => 'Mr or Ms Sing 2017',
                'type' => 'customer_database_manager_event',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:54:16',
                'updated_at' => '2020-12-24 19:54:16',
                'value' => NULL,
            ),
            71 =>
            array (
                'id' => 74,
                'name' => 'We go together 3.2019',
                'type' => 'customer_database_manager_event',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:54:22',
                'updated_at' => '2020-12-24 19:54:22',
                'value' => NULL,
            ),
            72 =>
            array (
                'id' => 75,
                'name' => 'Go Australia 2.2020',
                'type' => 'customer_database_manager_event',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:54:28',
                'updated_at' => '2020-12-24 19:54:28',
                'value' => NULL,
            ),
            73 =>
            array (
                'id' => 76,
                'name' => 'Chọn chương trình hè',
                'type' => 'customer_database_manager_study_tour',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2020-12-24 19:54:47',
                'updated_at' => '2020-12-24 19:54:47',
                'value' => NULL,
            ),
            74 =>
            array (
                'id' => 77,
                'name' => 'Facebook cá nhân',
                'type' => 'source_post_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-05 19:46:05',
                'updated_at' => '2021-01-05 19:46:05',
                'value' => NULL,
            ),
            75 =>
            array (
                'id' => 78,
                'name' => 'Fanpage',
                'type' => 'source_post_media',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-05 19:46:41',
                'updated_at' => '2021-01-07 19:56:02',
                'value' => '["San sang du hoc","OSHC students","OSHC global"]',
            ),
            76 =>
            array (
                'id' => 79,
                'name' => 'Service info',
                'type' => 'task_media_category_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:37:43',
                'updated_at' => '2021-01-11 21:37:43',
                'value' => NULL,
            ),
            77 =>
            array (
                'id' => 80,
                'name' => 'Branding',
                'type' => 'task_media_category_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:37:52',
                'updated_at' => '2021-01-11 21:37:52',
                'value' => NULL,
            ),
            78 =>
            array (
                'id' => 81,
                'name' => 'Promotion',
                'type' => 'task_media_category_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:38:00',
                'updated_at' => '2021-01-11 21:38:00',
                'value' => NULL,
            ),
            79 =>
            array (
                'id' => 82,
                'name' => 'Offshore User',
                'type' => 'task_media_object_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:38:16',
                'updated_at' => '2021-01-11 21:38:16',
                'value' => NULL,
            ),
            80 =>
            array (
                'id' => 83,
                'name' => 'Onshore User',
                'type' => 'task_media_object_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:38:25',
                'updated_at' => '2021-01-11 21:38:25',
                'value' => NULL,
            ),
            81 =>
            array (
                'id' => 84,
                'name' => 'Student',
                'type' => 'task_media_object_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:38:34',
                'updated_at' => '2021-01-11 21:38:34',
                'value' => NULL,
            ),
            82 =>
            array (
                'id' => 85,
                'name' => 'Parent',
                'type' => 'task_media_object_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:38:41',
                'updated_at' => '2021-01-11 21:38:41',
                'value' => NULL,
            ),
            83 =>
            array (
                'id' => 86,
                'name' => 'Cashback voucher',
                'type' => 'task_media_type_of_promotion_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:39:03',
                'updated_at' => '2021-01-11 21:39:03',
                'value' => NULL,
            ),
            84 =>
            array (
                'id' => 87,
                'name' => 'Shoping voucher',
                'type' => 'task_media_type_of_promotion_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:39:14',
                'updated_at' => '2021-01-11 21:39:14',
                'value' => NULL,
            ),
            85 =>
            array (
                'id' => 88,
                'name' => 'Lucky draw',
                'type' => 'task_media_type_of_promotion_email_marketing',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-11 21:39:24',
                'updated_at' => '2021-01-11 21:39:24',
                'value' => NULL,
            ),
            86 =>
            array (
                'id' => 89,
                'name' => 'Website',
                'type' => 'source_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-12 15:47:58',
                'updated_at' => '2021-01-12 15:47:58',
                'value' => NULL,
            ),
            87 =>
            array (
                'id' => 90,
                'name' => 'Facebook',
                'type' => 'source_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-12 15:48:05',
                'updated_at' => '2021-01-12 15:48:05',
                'value' => NULL,
            ),
            88 =>
            array (
                'id' => 91,
                'name' => 'Fanpage',
                'type' => 'source_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-12 15:48:11',
                'updated_at' => '2021-01-12 15:48:11',
                'value' => NULL,
            ),
            89 =>
            array (
                'id' => 92,
                'name' => 'Group',
                'type' => 'source_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-12 15:48:15',
                'updated_at' => '2021-01-12 15:48:15',
                'value' => NULL,
            ),
            90 =>
            array (
                'id' => 93,
                'name' => 'Blog',
                'type' => 'source_archive_media_link',
                'is_success' => NULL,
                'color' => NULL,
                'created_at' => '2021-01-12 15:48:20',
                'updated_at' => '2021-01-12 15:48:20',
                'value' => NULL,
            ),
        ));


    }
}
