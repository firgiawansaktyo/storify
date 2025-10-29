<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wedding extends Model
{
    protected $table = 'weddings';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'wedding_image',
        'wedding_title',
        'wedding_sub_title',
        'wedding_description',
        'wedding_prayer_verse',
        'wedding_video',
        'wedding_audio',
        'wedding_message_template',
        'wedding_landing_image',
        'wedding_landing_title',
        'wedding_hotnews_image',
        'wedding_hotnews_description',
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
