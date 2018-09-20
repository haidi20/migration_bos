<?php 
namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Setting extends Model
{
    protected $keyType   = 'string';
    public $incrementing = false;
    protected $fillable  = ['key', 'value'];
    public $timestamps   = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }

    public function scopeKey($query, $key)
    {
    	return $query->where('key', $key);
    }
}