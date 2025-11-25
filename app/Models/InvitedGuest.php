<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InvitedGuest extends Model
{
    protected $table = 'invited_guests';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        static::creating(function ($guest) {
            if (empty($guest->slug) && !empty($guest->name)) {
                $guest->slug = Str::slug($guest->name);
            }
        });

        static::updating(function ($guest) {
            if ($guest->isDirty('name')) {
                $guest->slug = Str::slug($guest->name);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messageTemplate() {
        return $this->hasOne(Wedding::class, 'invited_guest_id', 'id');
    }
    

}
