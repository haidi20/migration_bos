<?php 
namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Group_member extends Model
{
    public $timestamps   = false;
    protected $keyType   = 'string';
    public $incrementing = false;

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

    public function user()
    {
        return $this->belongsTo('App\Web\Models\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Web\Models\User_group', 'group_id');
    }

    public function getDisplayUserGroupIdAttribute()
    {
    	if($this->group){
    		return $this->group->id;
    	}
    }

    public function getDisplayUserGroupNameAttribute()
    {
        if($this->group){
            return $this->group->name;
        }
    }

    public function getDisplayUserNameAttribute()
    {
        if($this->user){
            return $this->user->name;
        }
    }

    public function getDisplayUserPreviewAttribute()
    {
    	if($this->user){
    		return $this->user->preview_media_img_circle;
    	}
    }

    public function getImageGroupAttribute()
    {
        if($this->group){
            return $this->group->image_group;
        }
    }
}