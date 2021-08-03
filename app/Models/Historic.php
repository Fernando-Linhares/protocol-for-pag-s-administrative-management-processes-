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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doc()
    {
        return $this->belongsTo(Document::class,'doc_id','id');
    }


    public function scopeGetCronogram($query, int $id)
    {
        return $query->where('doc_id', $id)
        ->get()
        ->map(
            function($historic){

                $date = date("d/m/Y" ,strtotime($historic->created_at));
                return collect([
                    'user' => $historic->user->name,
                    'date' => $date
                ]);
            }
        );
    }
}
