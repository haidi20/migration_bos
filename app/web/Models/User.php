<?php

namespace App\Web\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;

    protected $keyType   = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSorted($query, $by='id', $sort='ASC')
    {
        return $query->orderBy($by, $sort);
    }

    public function scopeSearch($query, $by, $key)
    {
        return $query->where($by, 'LIKE', '%'.$key.'%');
    }

    public function scopeLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeActive($query)
    {
        return $query->where('isDelete', 0);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function member()
    {
        return $this->hasOne('App\Web\Models\Group_member');
    }

    public function members()
    {
        return $this->hasMany('App\Web\Models\Group_member');
    }

    public function photo()
    {
        return $this->morphOne('App\Web\Models\File', 'ref');
    }

    public function getSessionGroupIdFirstAttribute()
    {
        if($this->member){
            return $this->member->id;
        }
    }

    public function getSessionGroupIdAttribute()
    {
        $group_session = session()->get('group');
        if($group_session){
            return $group_session;
        }
    }

    public function getSessionGroupNameAttribute()
    {
        if($this->session_group_id){
            $group = User_group::find($this->session_group_id);
            return $group->name;
        }
    }

    public function getAccessAttribute()
    {
        $group_name = request()->route()->getName();
        $check = Group_access::where('group_id', $this->session_group_id)->where('module', $group_name)->first();
        if($check){
            return $check;
        }
    }

    public function getArrayActionAttribute()
    {
        if($this->access){
            $array = json_decode($this->access->actions);
            return collect($array)->toArray();
        }

    }

    public function getPermissionIndexAttribute()
    {
        $check = $this->access;
        if($check){
            return true;
        }else{
            return false;
        }
    }

    public function getPermissionDetailAttribute()
    {
        if($this->permission_index && in_array('detail', $this->array_action)){
            return true;
        }else{
            return false;
        }
    }

    public function getPermissionCreateAttribute()
    {
        if($this->permission_index && in_array('create', $this->array_action)){
            return true;
        }else{
            return false;
        }
    }

    public function getPermissionEditAttribute()
    {
        if($this->permission_index && in_array('edit', $this->array_action)){
            return true;
        }else{
            return false;
        }
    }

    public function getPermissionDeleteAttribute()
    {
        if($this->permission_index && in_array('delete', $this->array_action)){
            return true;
        }else{
            return false;
        }
    }

    public function getPermissionPrintAttribute()
    {
        if($this->permission_index && in_array('print', $this->array_action)){
            return true;
        }else{
            return false;
        }
    }

    public function getPermissionActionsAttribute()
    {
        if($this->permission_edit || $this->permission_delete){
            return true;
        }else{
            return false;
        }
    }

    public function preview($width=null, $height=null, $link=false, $class="", $id="", $css="")
    {
        if( is_object($this->photo) ){
            if($width || $height){
                $url = image_fit($this->photo->id, (int) $width, $height);
                $style = 'style="min-height: ' . $height .'px"';
            }else{
                $url = asset('storages/image/'.$this->photo->name);
                $style = '';
            }
        }else{
            //$url = 'http://placehold.it/' . $width . 'x' . $height;
            $url = asset('img/jpg/empty.jpg');
            //$url = asset('img/png/sorry-image-not-available.png');
            //$url = 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s=500'; //get gravatar
            $style = '';
        }

        if($link) return $url;

        return '<img alt="image" src="' . $url . '" class="'.$class.'" id="'.$id.'" style="'.$css.'">';
    }

    public function getPreviewPhotoProfileAttribute()
    {
        return $this->preview(300, 300, false, 'img-responsive img-thumbnail img-fluid', 'gambar');
    }

    public function getPreviewPhotoProfileCircleAttribute()
    {
        return $this->preview(150, 150, false, 'media-object img-xl rounded-circle', 'gambar');
    }

    public function getPreviewImgCircleAttribute()
    {
        return $this->preview(50, 50, false, 'img-circle');
    }

    public function getPreviewMediaImgCircleAttribute()
    {
        return $this->preview(50, 50, false, 'media-object rounded-circle', '', 'width: 48px; height: 48px;');
    }

    public function getDisplayStatusAttribute()
    {
        return config('library.user.status.'.$this->status);
    }
}
