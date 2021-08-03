<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','unit','number','vol','user_id','acepted'];

    public function getDateAttribute()
    {
        return strftime("%Y",strtotime($this->created_at));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
