<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','doc_id','acept','created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doc()
    {
        return $this->belongsTo(Document::class);
    }


    public function scopeDocumentsOf($query, int $user, bool $acept=false)
    {
        return $query->where('user_id',$user)->where('acept',$acept)->get();
    }
}
