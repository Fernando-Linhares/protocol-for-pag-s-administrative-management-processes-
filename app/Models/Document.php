<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable=['title','content','unit','number','vol'];

    public function getDateAttribute()
    {
        return strftime("%Y",strtotime($this->created_at));   
    }
}
