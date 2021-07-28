<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Phieuthu extends Model
{
    protected $fillable = [
        'apply_id',
        'payer',
        'address',
        'account_bank',
        'note',
        'code',
        'current_id',
        'amount',
        'net_amount',
        'bank_fee',
        'exchange_rate',
        'type',
        'type_payment',
        'admin_create',
        'admin_update',
        'receipt_net_amount',
        'date_receipt',
        'exchange_rate'
    ];
    public static function getList($request)
    {
        return static::when($request->created_at, function ($query) use ($request) {
            $query->whereBetween('created_at', dateRangePicker($request->created_at));
        })->when($request->number_invoice, function ($query) use ($request) {
            $query->where('code', 'LIKE', '%' . $request->number_invoice . '%');
        })
            ->paginate(10);;
    }

    public function invoice()
    {
        return $this->belongsTo('App\Admin\Apply', 'apply_id');
    }

    public function creater()
    {
        return $this->belongsTo('App\Admin', 'admin_create');
    }

    public function updater()
    {
        return $this->belongsTo('App\Admin', 'admin_update');
    }
    public function getCurrency(){
        return (!empty($this->current_id) && !empty(config('myconfig.currency')[$this->current_id]))?config('myconfig.currency')[$this->current_id]:'';
    }
}
