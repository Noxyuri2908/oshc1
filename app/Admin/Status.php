<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $table='statuses';
    protected $fillable = [
        'name',
        'type',
        'is_success',
        'color',
        'value'
    ];
    public static $TYPE = [
        'category_media',
        'type_source_media',
        'web_media',
        'group_media',
        'source_post_media',
        'from_archive_media_link',
        'type_archive_media_link',
        'information_focused_archive_media_link',
        'web_media_content',
        'category_archive_media_link',
        'source_archive_media_link',
        'type_domain_hosting',
        'domain_mail_skype',
        'category_marketing_material',
        'use_for_marketing_material',
        'target_marketing_material',
        'type_marketing_material',
        'department_staff',
        'branch_staff',
        'position_staff',
        'customer_database_manager_type_of_customer',
        'customer_database_manager_resource',
        'customer_database_manager_english_center',
        'customer_database_manager_event',
        'customer_database_manager_study_tour',
        'task_media_category_email_marketing',
        'task_media_object_email_marketing',
        'task_media_type_of_promotion_email_marketing',
        'sale_task_assign_type',
        'solution_it_checklist'
    ];
    public static $TYPEOFSTATUS = [
        1=>'sale_task_assign_type_choose_agent'
    ];
}
