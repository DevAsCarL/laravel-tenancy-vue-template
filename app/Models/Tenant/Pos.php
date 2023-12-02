<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pos extends TenantModel
{
    use SoftDeletes;
    protected $with = ['establishment', 'sales', 'user', 'cash_register', 'denominationPos'];
    protected $fillable = [
        'id',
        'user_id',
        'establishment_id',
        'cash_register_id',
        'open_amount_pen',
        'open_amount_usd',
        'close_amount',
        'close_amount_pen',
        'close_amount_usd',
        'sales_count',
        'is_new',
        'status',
        'created_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'deleted_at'
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

    public function sales()
    {
        return $this->hasMany(PosSales::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*public static function active()
    {
        $configuration = Configuration::first();
        if ($configuration->roles_waitress_cashier) {
            $pos = Pos::select('id')->where('establishment_id', auth()->user()->establishment_id)
                ->where('status', 'open')->orderBy('id', 'desc')->first();
            return ($pos) ? $pos->id : 0;
        } else {
            $pos = auth()->user()->pos()->orderBy('id', 'desc')->where('status', 'open');
            $id = $pos->count() ? $pos->first()->id : 0;
            return $id;
        }

    }*/

    public static function is_active($id)
    {
        $pos = Pos::select('id')->where('status', 'open')->where('id', $id)->first();
        return ($pos) ? true : false;
    }

    public function denominationPos()
    {
        return $this->hasMany(DenominationPos::class, 'pos_id');
    }
}
