<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use MatanYadaev\EloquentSpatial\Objects\Point;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    
    public function anime()
    {
    return $this->belongsTo(Anime::class);
    }
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'point',
        'anime_id',
        'image_url',
        ];
    protected $casts = [
        'point' => Point::class,
    ];
    
    function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('user','anime')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    

}
?>

