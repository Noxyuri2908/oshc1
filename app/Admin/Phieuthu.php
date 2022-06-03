<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    static public function importReceipt($data)
    {
        $result = [];
        $result['apply_id'] = Apply::select('id')->where('ref_no', $data['invoice_no'])->first()->id;
        $result['payer'] = $data['payer'];
        $result['type_payment'] = $data['type_of_payment'];
        $result['account_bank'] = $data['account'];
        $result['note'] = $data['note'];
        $result['amount'] = convert_number_currency_to_db($data['amount_of_money']);
        $result['current_id'] = getKeyConfigByValue(config('myconfig.currency'), $data['unit']);
        $result['date_receipt']= convert_date_to_db($data['date_of_receipt']);
        $result['receipt_net_amount'] = !empty($data['net_amount']) ? str_replace(',','',$data['net_amount']):0;
        $result['current_id'] = getKeyConfigByValue(config('myconfig.currency'), $data['unit']);
        $result['bank_fee'] = convert_number_currency_to_db($data['bank_fee']);
        $result['type'] = getKeyConfigByValue(config('myconfig.type_receipt'), $data['type_of_receipt']);
        $result['admin_create'] = Auth::user()->id;
        try {
            Phieuthu::create($result);
        }catch (\Exception $e) {
            echo $e->getMessage();die;
        }
        return;

    }
}
