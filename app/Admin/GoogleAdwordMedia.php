<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class GoogleAdwordMedia extends Model
{
    //
    protected $table = 'google_adword_media';
    protected $fillable = [
        'start_date',
        'end_date',
        'website_id',
        'campaign',
        'location_search',
        'language_search',
        'type_campaign',
        'bid_price',
        'keyword',
        'title_1',
        'title_2',
        'title_3',
        'describe',
        'link_post',
        'number_days',
        'budget',
        'number_click_expected',
        'number_click_reality',
        'number_impression',
        'average_CPC',
        'created_by'
    ];
    public function getWebsiteName(){
        $website_id = $this->website_id;
        if(!empty($website_id)){
            $website = Status::where('id',$website_id)->first();
            return (!empty($website))?$website->name:'';
        }
        return '';
    }
    public function getCountryName(){
        $language_search = $this->language_search;
        if(!empty($language_search)){
            $country = !empty(config('country.list')[$language_search])?config('country.list')[$language_search]:'';
            return $country;
        }
        return '';
    }
}
