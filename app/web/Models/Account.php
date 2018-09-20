<?php 
namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Account extends Model
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

    public function scopeIsParent($query)
    {
        return $query->where('parent_id', 0);
    }

    public function child()
    {
    	return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
    	return $this->belongsTo(self::class, 'parent_id');
    }

    public function getDisplayParentAttribute()
    {
        if(method_exists($this, 'display_parent')){
            $parent[] = object_get($this, 'display_parent');
        }
        $parent[] = object_get($this->parent, 'name');

        return implode(' / ', array_filter($parent)) ?: '';
    }

    public function getDisplayParentOfAttribute()
    {
        return implode(' / ', array_filter([$this->display_parent, $this->name]));
    }

    public function getCountChildAttribute()
    {
    	if(count($this->child)){
    		return '<span class="badge">'.count($this->child).'</span>';
    	}
    }
    
}