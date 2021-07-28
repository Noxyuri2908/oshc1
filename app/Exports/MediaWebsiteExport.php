<?php

namespace App\Exports;

use App\Admin\MediaPost;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MediaWebsiteExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($request,$getMediaPost)
    {
        $this->request = $request;
        $this->getMediaPost = $getMediaPost;
    }

    public function headings(): array
    {
        $getMediaPost = $this->getMediaPost;
        if (!empty($getMediaPost)) {
            if ($getMediaPost == 1) {
                return [
                    'Web',
                    'Lên lịch hẹn đăng bài',
                    'Ngày đăng',
                    'CHUYÊN MỤC',
                    'BÀI POST',
                    'LINK POST',
                    'Nguồn bài',
                    'Chi tiết nguồn bài',
                    'Loại bài DV',
                    'Loại tin bài',
                    'Nguồn bài PR',
                    'Lượt view',
                    'Đánh giá',
                    'Fanpage',
                    'Gửi Newsletter',
                    'Bài viết chuẩn SEO',
                    'Người đăng',
                    'NOTE'
                ];
            }
            elseif ($getMediaPost == 2){
                return [
                    'Web',
                    'Lên lịch hẹn đăng bài',
                    'Ngày đăng',
                    'CHUYÊN MỤC',
                    'BÀI POST',
                    'LINK POST',
                    'Nguồn bài',
                    'Loại bài DV',
                    'Loại tin bài',
                    'Nguồn bài PR',
                    'Reach',
                    'Like',
                    'Share',
                    'Inbox',
                    'Đánh giá',
                    'NOTE',
                    'Budget QC/ngày',
                    'Đối tượng QC',
                    'Start date',
                    'Days',
                    'Total budget',
                    'Credit card'
                ];
            }elseif ($getMediaPost == 3){
                return [
                    'Group',
                    'Ngày đăng',
                    'CHUYÊN MỤC',
                    'BÀI POST',
                    'LINK POST',
                    'Người Up',
                    'Loại tin bài',
                    'Reach',
                    'Like',
                    'Share',
                    'Inbox',
                    'Đánh giá',
                    'Nguồn bài',
                    'NOTE'
                ];
            }elseif($getMediaPost == 4){
                return [
                    'Ngày gửi',
                    'Hạng mục email MKT',
                    'Dịch vụ',
                    'Tiêu đề',
                    'Đối tượng gửi',
                    'Lượt mở email',
                    'Lượt click link',
                    'Hình thức promotion',
                    'User Onshore',
                    'User OFFshore',
                    'Số lượng promotion',
                    'AUD',
                    'VND',
                    'Tổng tiền',
                    'NOTE'
                ];
            }
        }

    }

    public function collection()
    {
        $statuses = \App\Admin\Status::whereIn('type', [
            'category_media',
            'type_source_media',
            'web_media',
            'group_media',
            'source_post_media',
            'task_media_category_email_marketing',
            'task_media_object_email_marketing',
            'task_media_type_of_promotion_email_marketing',
            'source_archive_media_link',
        ])->get(['id', 'name', 'type', 'value']);
        $categoryEmailMarketing = $statuses->where('type', 'task_media_category_email_marketing');
        $objectEmailMarketing = $statuses->where('type', 'task_media_object_email_marketing');
        $typeOfPromotionEmailMarketing = $statuses->where('type', 'task_media_type_of_promotion_email_marketing');
        $webMedia = $statuses->where('type', 'web_media');
        $webMediaValue = $webMedia->pluck('value')->map(function ($query) {
            return !empty($query) ? json_decode($query, true) : [];
        });
        $typeSourceMedia = $statuses->where('type', 'type_source_media');

        $sourcePostMedias = $statuses->where('type', 'source_archive_media_link');
        $archiveMediaList = \App\Admin\ArchiveMediaLink::get(['id', 'source_id', 'name'])->groupBy('source_id');
        $sourcePostMedias = $sourcePostMedias->map(function ($item, $key) use ($archiveMediaList) {
            return collect([
                'id'=>$item->id,
                'name'=>$item->name,
                'value'=>!empty($archiveMediaList[$item->id])?$archiveMediaList[$item->id]->pluck('name')->toJson():''
            ]);
        });
        //dd($sourcePostMedias);
        $groupMedias = $statuses->where('type', 'group_media');
        $services = \App\Admin\Dichvu::get([
            'name',
            'id',
        ]);
        $rates = \App\Admin\MediaPost::$RATE;
        $seos = \App\Admin\MediaPost::$SEO;
        $types = \App\Admin\MediaPost::$TYPE;
        $admins = \App\Admin::pluck('username', 'id');

        $request = $this->request;
        $getMediaPost = $this->getMediaPost;
        $startDateSchedule = convert_date_to_db($request->get('schedule_post_date_start'));
        $endDateSchedule = convert_date_to_db($request->get('schedule_post_date_end'));
        $startDateCreatedPost = convert_date_to_db($request->get('created_post_start'));
        $endDateCreatedPost = convert_date_to_db($request->get('created_post_end'));
        $startDateFanpagePost = convert_date_to_db($request->get('post_date_fanpage_start'));
        $endDateFanpagePost = convert_date_to_db($request->get('post_date_fanpage_end'));
        $startDateNewsletter = convert_date_to_db($request->get('post_date_newletter_start'));
        $endDateNewsletter = convert_date_to_db($request->get('post_date_newletter_end'));
        $mediaPosts = MediaPost::when($request->get('post_place_id'), function ($query) use ($request) {
            $query->where('post_place_id', $request->get('post_place_id'));
        })->when($request->get('group_id'), function ($query) use ($request) {
            $query->where('group_id', $request->get('group_id'));
        })->when($startDateSchedule && $endDateSchedule, function ($query) use ($request, $startDateSchedule, $endDateSchedule) {
            $query->whereBetween('schedule_post_date', [$startDateSchedule, $endDateSchedule]);
        })->when($request->get('category'), function ($query) use ($request) {
            $query->where('category', $request->get('category'));
        })->when($request->get('post_title'), function ($query) use ($request) {
            $query->where('post_title','LIKE', '%'.$request->get('post_title').'%');
        })->when($request->get('post_link'), function ($query) use ($request) {
            $query->where('post_link','LIKE', '%'.$request->get('post_link').'%');
        })->when($request->get('service_id'), function ($query) use ($request) {
            $query->where('service_id', $request->get('service_id'));
        })->when($request->get('type_source'), function ($query) use ($request) {
            $query->where('type_source', $request->get('type_source'));
        })->when($request->get('source_pr'), function ($query) use ($request) {
            $query->where('source_pr', 'LIKE', '%' . $request->get('source_pr') . '%');
        })->when($request->get('source_pr'), function ($query) use ($request) {
            $query->where('source_pr', 'LIKE', '%' . $request->get('source_pr') . '%');
        })->when($request->get('rate'), function ($query) use ($request) {
            $query->where('rate', $request->get('rate'));
        })->when($startDateFanpagePost && $endDateFanpagePost, function ($query) use ($request, $startDateFanpagePost, $endDateFanpagePost) {
            $query->whereBetween('post_date_fanpage', [$startDateFanpagePost, $endDateFanpagePost]);
        })->when($startDateNewsletter && $endDateNewsletter, function ($query) use ($request, $startDateNewsletter, $endDateNewsletter) {
            $query->whereBetween('post_date_newletter', [$startDateNewsletter, $endDateNewsletter]);
        })->when($request->get('created_by'), function ($query) use ($request) {
            $query->where('created_by', $request->get('created_by'));
        })->when($request->get('note'), function ($query) use ($request) {
            $query->where('note', 'LIKE', '%' . $request->get('note') . '%');
        })->when($request->get('budget_qc'), function ($query) use ($request) {
            $query->where('budget_qc','LIKE', '%'.$request->get('budget_qc').'%');
        })->when($request->get('tag'), function ($query) use ($request) {
            $query->where('tag','LIKE', '%'.$request->get('tag').'%');
        })->when($request->get('start_date_qc'), function ($query) use ($request) {
            $query->whereDate('start_date_qc',convert_date_to_db($request->get('start_date_qc')));
        })->when($request->get('total_budget'), function ($query) use ($request) {
            $query->where('total_budget','LIKE', '%'.$request->get('total_budget').'%');
        })->when($request->get('credit_card'), function ($query) use ($request) {
            $query->where('credit_card','LIKE', '%'.$request->get('credit_card').'%');
        })->when($request->get('source_post'), function ($query) use ($request) {
            $query->where('source_post',$request->get('source_post'));
        })->when($request->get('source_detail'), function ($query) use ($request) {
            $query->where('source_detail',$request->get('source_detail'));
        })
        ->with(['typeMediaPosts', 'user']);
        $mediaPostName = MediaPost::$TYPE[$getMediaPost];
        $media=[];
        if (!empty($getMediaPost)) {
            if ($getMediaPost == 1) {
                if(!$request->user()->can('mediaManagerWebsite.index'))abort(403);
                if ($startDateCreatedPost && $endDateCreatedPost)
                {
                    $mediaPosts = $mediaPosts->whereHas('typeMediaPosts', function ($query) use ($getMediaPost, $request, $startDateCreatedPost, $endDateCreatedPost) {
                        $query->where('type_id', $getMediaPost)
                            ->whereBetween('post_date', [$startDateCreatedPost, $endDateCreatedPost]); // query filter post_date
                    })->orderBy('id', 'desc')->get();
                }else{
                    $mediaPosts = $mediaPosts->orderBy('id', 'desc')->get();
                }
                foreach ($mediaPosts as $item) {
                    $media[] = array(
                        $webMedia->where('id',$item->post_place_id)->pluck('name')->first(),
                        convert_date_form_db($item->schedule_post_date),
                        convert_date_form_db($item->typeMediaPosts->where('type_id',$getMediaPost)->first()->post_date),
                        $item->category,
                        $item->post_title,
                        $item->post_link,
                        $sourcePostMedias->where('id',$item->source_post)->pluck('name')->first(),
                        $item->source_detail,
                        !empty($services->where('id',$item->service_id)->pluck('name')->first())?$services->where('id',$item->service_id)->pluck('name')->first():'',
                        $item->type_source,
                        $item->source_pr,
                        $item->view,
                        $item->getRate(),
                        convert_date_form_db($item->post_date_fanpage),
                        convert_date_form_db($item->post_date_newletter),
                        $item->getSeo(),
                        !empty($admins[$item->created_by])?$admins[$item->created_by]:'',
                        $item->note
                    );
                }
                return collect($media);
            } elseif ($getMediaPost == 2) {
                if(!$request->user()->can('mediaManagerFanpage.index'))abort(403);

                if ($startDateCreatedPost && $endDateCreatedPost)
                {
                    $mediaPosts = $mediaPosts->whereHas('typeMediaPosts', function ($query) use ($getMediaPost, $request, $startDateCreatedPost, $endDateCreatedPost) {
                        $query->where('type_id', $getMediaPost)
                                ->whereBetween('post_date', [$startDateCreatedPost, $endDateCreatedPost]); // query filter post_date
                    })->orderBy('id', 'desc')->get();
                }else{
                    $mediaPosts = $mediaPosts->orderBy('id', 'desc')->get();
                }
                foreach ($mediaPosts as $item) {
                    $media[] = array(
                        $webMedia->where('id',$item->post_place_id)->pluck('name')->first(),
                        convert_date_form_db($item->schedule_post_date),
                        convert_date_form_db($item->typeMediaPosts->where('type_id',$getMediaPost)->first()->post_date),
                        $item->category,
                        $item->post_title,
                        $item->post_link,
                        $sourcePostMedias->where('id',$item->source_post)->pluck('name')->first(),
                        $services->where('id',$item->service_id)->pluck('name')->first(),
                        $item->type_source,
                        $item->source_pr,
                        $item->react,
                        $item->like,
                        $item->share,
                        $item->inbox,
                        $item->getRate(),
                        $item->note,
                        $item->budget_qc,
                        $item->tag,
                        convert_date_form_db($item->start_date_qc),
                        $item->number_days,
                        $item->total_budget,
                        $item->credit_card
                    );
                }
                return collect($media);
            } elseif ($getMediaPost == 3) {
                if(!$request->user()->can('mediaManagerGroup.index'))abort(403);
                $mediaPosts = $mediaPosts->where('type_media_post', 3)->orderBy('id', 'desc')->get();
                foreach ($mediaPosts as $data) {
                    $media[] = array(
                        $groupMedias->where('id',$data->group_id)->pluck('name')->first(),
                        convert_date_form_db($data->created_post),
                        $data->category,
                        $data->post_title,
                        $data->post_link,
                        !empty($admins[$data->created_by])?$admins[$data->created_by]:'',
                        $data->type_source,
                        $data->react,
                        $data->like,
                        $data->share,
                        $data->inbox,
                        $data->getRate(),
                        $sourcePostMedias->where('id',$data->source_post)->pluck('name')->first(),
                        $data->note
                    );
                }
                return collect($media);
            } elseif ($getMediaPost == 4) {
                if(!$request->user()->can('mediaManagerWebsite.index'))abort(403);
                $mediaPosts = $mediaPosts->whereNotNull('post_date_newletter')->where('type_media_post', 4)->orderBy('id', 'desc')->get();
                foreach ($mediaPosts as $data) {
                    $media[] = array(
                        convert_date_form_db($data->post_date_newletter),
                        $categoryEmailMarketing->where('id',$data->category_email_marketing)->pluck('name')->first(),
                        !empty($services->where('id',$data->service_id)->pluck('name')->first())?$services->where('id',$data->service_id)->pluck('name')->first():'',
                        $data->post_title,
                        $objectEmailMarketing->where('id',$data->object_email_marketing)->pluck('name')->first(),
                        $data->number_of_selected_email_marketing,
                        $data->number_of_clicked_link_email_marketing,
                        $typeOfPromotionEmailMarketing->where('id',$data->type_of_promotion_email_marketing)->pluck('name')->first(),
                        $data->number_of_agent_onshore_email_marketing,
                        $data->number_of_agent_offshore_email_marketing,
                        $data->number_of_promotion_email_marketing,
                        $data->amount_of_money_aud_email_marketing,
                        $data->amount_of_money_vnd_email_marketing,
                        $data->total_amount_of_money_email_marketing,
                        $data->note_email_marketing
                    );
                }
                return collect($media);
            }
        }

    }
}
