<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'anime_id',
        'image_url',
        ];
    
       function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

}
?>

