<?php 
namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class User_group extends Model
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

    public function members()
    {
        return $this->hasMany('App\Web\Models\Group_member', 'group_id');
    }

    public function access()
    {
        return $this->hasMany('App\Web\Models\Group_access', 'group_id');
    }

    public function photo()
    {
        return $this->morphOne('App\Web\Models\File', 'ref');
    }

    public function preview($width=null, $height=null, $link=false, $class="", $id="", $css="")
    {
        if($this->img_type == 1){
            $url = asset('robust/app-assets/images/gallery/'.$this->img_group);
        }else{
            if( is_object($this->photo) ){
                if($width || $height){
                    $url = image_fit($this->photo->id, (int) $width, $height);
                    $style = 'style="min-height: ' . $height .'px"';
                }else{
                    $url = asset('storages/image/'.$this->photo->name);
                    $style = '';
                }
            }else{
                $img_default = config('gallery.group')[0];
                $url = asset('robust/app-assets/images/gallery/'.$img_default);
                $style = '';
            }
        }

        if($link) return $url;

        return '<img alt="image" src="' . $url . '" class="'.$class.'" id="'.$id.'" style="'.$css.'">';
    }

    public function getPreviewImageGroupAttribute()
    {
        return $this->preview(300, 225, false, 'img-responsive img-thumbnail img-fluid', 'gambar');
    }

    public function getImageGroupAttribute()
    {
        return $this->preview(300, 200, false, 'card-img-top img-fluid', 'gambar');
    }
}