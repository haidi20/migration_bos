<?php 
namespace App\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Log extends Model
{
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

    public function scopeType($query, $type)
    {
        return $query->whereType($type);
    }

    public function user()
    {
    	return $this->belongsTo('App\Web\Models\User');
    }

    public function getDisplayUserAttribute()
    {
        if($this->user){
            return $this->user->name;
        }
    }

    public function getDisplayInputAttribute()
    {
        if($this->input){
            if($this->in_url != 'authentication'){
                return '<strong>dengan inputan</strong> '.$this->input;
            }else{
                return $this->input;
            }
        }
    }

    public function getPrettyDateAttribute()
    {
        return pretty_date($this->created_at, true, true);
    }

    public function getDisplayTimeAttribute()
    {
        return format_time($this->created_at, true);
    }

    public function getDisplayActionAttribute()
    {
        $open_from = '';
        if($this->action == 'login' || $this->action == 'logout'){
            if($this->open_from != ''){
                $open_from = ' from <strong>' . $this->open_from . '</strong>';
            }
        }

        return '<strong class="'.action_color($this->action).'">'.$this->description.'</strong>'.$open_from;
        //return '<span class="'.action_color($this->action).'">'.$this->action.' '.$this->in_url.'</span>'.$open_from;
    }

    public function getDisplayColorAttribute()
    {
        return action_color($this->action);
    }

    public function fileable()
    {
        return $this->morphTo(null, 'ref_type', 'ref_id');
    }

    public function fileables()
    {
        return $this->morphToMany(null, 'ref_type', 'ref_id');
    }

    public function getFilesAttribute()
    {
        $template = '';
        if($this->isFile){
            if($this->fileable->photos){
                //$template = '';
                foreach ($this->fileable->photos as $key => $value) {
                    $template .= '<figure class="col-md-3 col-sm-6 col-xs-12" itemprop="associatedMedia" itemscope itemtype="">';
                    $template .= '<a href="'.$value->url.'" itemprop="contentUrl" data-size="480x360">
                                    <img alt="" src="'.image_fit($value->id, 200, 150).'" class="img-responsive img-thumbnail img-fluid" itemprop="thumbnail">
                                  </a>';
                    $template .= '</figure>';
                }
                //$template .= '';

                return $template;
            }
            elseif($this->fileable->photo){
                $file = $this->fileable->photo;
                $id = $file->id;
                $url = $file->url;
                
                return '<figure class="col-md-3 col-sm-6 col-xs-12" itemprop="associatedMedia" itemscope itemtype="">
                            <a href="'.$url.'" itemprop="contentUrl" data-size="480x360">
                                <img src="'.image_fit($id, 200, 150).'" class="img-responsive img-thumbnail img-fluid" itemprop="thumbnail">
                            </a>
                        </figure>';
            }
        }
    }
    

    public function getDisplayIconAttribute()
    {
        $icon = '';
        switch ($this->open_from) {
            case 'web apps':
                $icon = 'globe';
                break;
            case 'android apps':
                $icon = 'android2';
                break;
        }

        if(in_array($this->action, ['login', 'logout'])){
            return fa($icon);
        }
    }

    public function getDisplayProgressAttribute()
    {
        return config('library.order.progress.'.$this->progress);
    }
}