<?php

namespace App\Admin;

use App\Admin;
use App\User;
use Illuminate\Database\Eloquent\Model;

class MediaPost extends Model
{
    //
    public static $TYPE = [
        1 => 'web_task',
        2 => 'fanpage_task',
        3 => 'group_task',
        4 => 'email_marketing',
    ];
    public static $RATE = [
        1 => 'A',
        2 => 'B',
        3 => 'C',
    ];
    public static $SEO = [
        1 => 'Ok',
        2 => 'Not ok',
    ];
    public static $TypePromotion = [
        1 => [
            'name' => 'Annalink',
            'type'=>'choose'
        ],
        2 => [
            'name' => 'Agent',
            'type'=>'show'
        ],
        3 => [
            'name' => 'School',
            'type'=>'choose'
        ],
    ];
    protected $table = 'media_posts';
    protected $fillable = [
        'type_media_post',
        'schedule_post_date',
        'category',
        'post_title',
        'post_link',
        'created_by',
        'source_post',
        'service_id',
        'type_source',
        'source_pr',
        'view',
        'rate',
        'post_date_fanpage',
        'post_date_newletter',
        'seo',
        'note',
        'react',
        'like',
        'share',
        'inbox',
        'budget_qc',
        'tag',
        'start_date_qc',
        'number_days',
        'created_post',
        'post_place_id',
        'reach',
        'like',
        'share',
        'inbox',
        'tag',
        'start_date_qc',
        'number_days',
        'total_budget',
        'credit_card',
        'group_id',
        'source_detail',
        'category_email_marketing',
        'object_email_marketing',
        'number_of_selected_email_marketing',
        'number_of_clicked_link_email_marketing',
        'type_of_promotion_email_marketing',
        'number_of_agent_onshore_email_marketing',
        'number_of_agent_offshore_email_marketing',
        'number_of_promotion_email_marketing',
        'amount_of_money_aud_email_marketing',
        'amount_of_money_vnd_email_marketing',
        'total_amount_of_money_email_marketing',
        'note_email_marketing',
        'post_website',
        'post_fanpage',
        'post_email_marketing',
        'post_group',
        'is_hotnew',
        'transfer_staff_date',
        'translated_by',
        'processing_date',
        'promote_date',
        'promotion_for',
        'promotion_for_agent_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'promotion_for_agent_id','id');
    }

    public function getUser()
    {
        $user_id = $this->created_by;
        if (!empty($user_id)) {
            $user = Admin::find($user_id);
            return (!empty($user)) ? $user->username : '';
        }
        return '';
    }

    public function getSeo()
    {
        $seo_id = $this->seo;
        if (!empty($seo_id)) {
            return (!empty($this::$SEO[$seo_id])) ? $this::$SEO[$seo_id] : '';
        }
        return '';
    }

    public function getRate()
    {
        $rate_id = $this->rate;
        if (!empty($rate_id)) {
            return (!empty($this::$RATE[$rate_id])) ? $this::$RATE[$rate_id] : '';
        }
        return '';
    }

    public function getService()
    {
        $service_id = $this->service_id;
        if (!empty($service_id)) {
            $service = Dichvu::find($service_id);
            return (!empty($service)) ? $service->name : '';
        }
        return '';
    }

    public function getWebsiteName()
    {
        $post_place_id = $this->post_place_id;
        if (!empty($post_place_id)) {
            $website = Status::where('id', $post_place_id)->first();
            return (!empty($website)) ? $website->name : '';
        }
        return '';
    }

    public function getGroupName()
    {
        $group_id = $this->group_id;
        if (!empty($group_id)) {
            $group = Status::where('id', $group_id)->first();
            return (!empty($group)) ? $group->name : '';
        }
        return '';
    }

    public function getWebsiteValue($type_id)
    {
        $post_place_id = $this->typeMediaPosts->where('type_id', $type_id)->first()->type_content_id;
        if (!empty($post_place_id)) {
            $website = TaskMediaStatus::find($post_place_id);
            return (!empty($website) && !empty($website->category)) ? $website->category : [];
        }
        return [];
    }

    public function getSourceValue()
    {
        $source_post_id = $this->source_post;

        if (!empty($source_post_id)) {
            $source_post = Status::where('id', $source_post_id)->first();
            return (!empty($source_post) && !empty(json_decode($source_post->value, true))) ? json_decode($source_post->value, true) : [];
        }
        return [];
    }

    public function typeMediaPosts()
    {
        return $this->belongsToMany(
            TypeMediaPost::class,
            'media_post_has_types',
            'media_post_id',
            'type_media_post_id'
        );
    }
}
