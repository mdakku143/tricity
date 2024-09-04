<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    use HasFactory;

    protected $table = "news";


    protected $fillable = [
        'title',
        'sub_title',
        'slug',
        'type',
        'category',
        'reporter_name',
        'state',
        'city',
        'image',
        'meta_seo',
        'meta_desc',
        'meta_keyword',
        'status',
        'is_verified'
    ];

    public function cities()
    {
        return $this->hasOne(CityModel::class, 'id', 'city')
            ->select('id', 'name', 'slug');
    }

    public function states()
    {
        return $this->hasOne(State::class, 'id', 'state')
            ->select('id', 'name', 'slug');
    }
    public function reporter()
    {
        return $this->hasOne(ReporterModel::class, 'id', 'reporter_name');
    }
    public function liveNews()
    {
        return $this->belongsTo(LiveNews::class, 'news_id', 'id');
    }
    public function newsCategory()
    {
        return $this->hasOne(MainMenuModel::class, 'id', 'category')
            ->select('id', 'name', 'slug');
    }
}
