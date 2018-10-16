<?php 
namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Item extends Model
{
    protected $keyType   = 'string';
    public $incrementing = false;
    public $timestamps   = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
	
	public function scopeSorted($query, $by='id', $sort='ASC')
	{
		return $query->orderBy($by, $sort);
	}

	public function scopeSearch($query, $by, $key)
    {
        return $query->where($by, 'LIKE', '%'.$key.'%');
    }

    public function scopeActive($query)
    {
        return $query->where('isDelete', 0);
    }

    public function getFormatPriceEstimateAttribute()
    {
        return number_format($this->price_estimate, 0, ',', '.');
    }

}