<?php

namespace App;

use App\Admin\EmployeeAccessList;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'role',
        'authorization',
        'password',
        'created_by',
        'status',
        'google_token',
        'branch_id',
        'date_of_birth',
        'admin_id',
        'address',
        'phone',
        'department_id',
        'position_id',
    ];

    protected $append = ['list_agent'];
    protected $with = [
        'roles',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthorizationAttribute()
    {
        $tmp = $this->attributes['authorization'];
        $res = [];
        if ($tmp != null && $tmp != "") {
            $res = explode(";", $tmp);
        }
        return $res;
    }

    public function getListAgentAttribute()
    {
        $res = [];
        $tmp = $this->id;
        $agents = User::all();
        foreach ($agents as $agent) {
            if ($agent->staff_id == $tmp || in_array($tmp, $agent->array_shares)) {
                $res[] = $agent->id;
            }
        }
        return User::whereIn('id', $res)->get();
    }

    public function staff()
    {
        return $this->belongsTo('App\Admin', 'created_by');
    }

    public function agents()
    {
        return $this->hasMany('App\User', 'staff_id');
    }

    public function getAccessEmployee($type)
    {
        $roleUsers = $this->roles->pluck('id');
        $typeSeeId = EmployeeAccessList::whereIn('role_id', $roleUsers)->where('permission_type', $type)->pluck('action_id')->unique();
        return $typeSeeId;
    }

    static function getIdByName($name)
    {
        if (!empty($name))
        {
            $admin = DB::table('admins')->select('id')->where('admin_id', $name)->first();
            return !empty($admin) ? $admin->id : '';
        }

        return '';
    }

    static function updateRoleCountries($id, $countries)
    {
        if (!empty($id))
        {
            $result = Admin::where('id', $id)->update(['role_countries' => \GuzzleHttp\json_encode($countries, true)]);
            return $result;

        }
    }
}
