<?php

namespace Chat\Message\Models;

use App\User;
use App\Http\Models\Model as MessageModel;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    
    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
}


