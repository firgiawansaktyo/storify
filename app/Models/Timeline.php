<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Timeline extends Model
{
    protected $table = 'timelines';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'wedding_vow_date',
        'wedding_vow_start_time',
        'wedding_vow_end_time',
        'wedding_vow_location',
        'wedding_vow_address',
        'wedding_vow_iframe',
        'wedding_reception_date',
        'wedding_reception_start_time',
        'wedding_reception_end_time',
        'wedding_reception_location',
        'wedding_reception_address',
        'wedding_reception_iframe',
        'wedding_vow_image',
        'wedding_reception_image',
        'wedding_vow_location_link',
        'wedding_reception_location_link',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
