<?php

namespace Chat\Message\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Model as MessageModel;


class Message extends Model
{
    protected $guarded = [];
    
    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
}
