<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Info;

class Person extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'position',
        'phone',
        'birthday',
        'email',
        'skype',
        'status',
        'facebook',
        'note',
        'is_receive_comm',
        'acc_name',
        'bank',
        'currency',
        'bank_address',
        'receiver_address',
        'swift_code'
    ];
    protected $table = 'people';

    public function agent()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public static function personExport($request)
    {
        $agentContactDatas = Person::select(
            'people.name',
            'people.position',
            'people.phone',
            'people.birthday',
            'people.email',
            'people.skype',
            'people.facebook',
            'people.note',
            'users.id',
            'users.name as agent_name',
            'users.staff_id',
            'users.department',
            'users.status',
            'users.country',
            'users.type_id'
        )
            ->join('users', 'users.id', '=', 'people.user_id')
            ->when($request->get('name'),function($query) use ($request){
                $query->where('name','LIKE','%'.$request->get('name').'%');
            })->when($request->get('type_id'),function($query) use ($request){
                $query->where('type_id',$request->get('type_id'));
            })->when($request->get('country'),function($query) use ($request){
                $query->where('country',$request->get('country'));
            })->when($request->get('status'),function($query) use ($request){
                $query->where('status',$request->get('status'));
            })->when($request->get('position'),function($query) use ($request){
                $query->where('position','LIKE','%'.$request->get('position').'%');
            })->when($request->get('phone'),function($query) use ($request){
                $query->where('phone','LIKE','%'.$request->get('phone').'%');
            })->when($request->get('birthday'),function($query) use ($request){
                $query->where('birthday','LIKE','%'.$request->get('birthday').'%');
            })->when($request->get('email'),function($query) use ($request){
                $query->where('email','LIKE','%'.$request->get('email').'%');
            })->when($request->get('skype'),function($query) use ($request){
                $query->where('skype','LIKE','%'.$request->get('skype').'%');
            })->when($request->get('facebook'),function($query) use ($request){
                $query->where('facebook','LIKE','%'.$request->get('facebook').'%');
            })->when($request->get('note'),function($query) use ($request){
                $query->where('note','LIKE','%'.$request->get('note').'%');
            })->when($request->get('user_id'),function($query) use ($request){
                $query->where('user_id',$request->get('user_id'));
            })
            ->when($request->get('department'),function($query) use ($request){
                $query->where('department',$request->get('department'));
            })
            ->when($request->get('staff_id'),function($query) use ($request){
                $query->where('staff_id',$request->get('staff_id'));
            })
            ->orderBy('id', 'desc')
            ->get();

        return $agentContactDatas;
    }
}
