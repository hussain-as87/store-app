<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'receiver', 'sender', 'read_at'];
    protected $casts = ['read_at' => 'DateTime'];

    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver');
    }

    public function readAt()
    {
        $this->forceFill([
            'read_at' => Carbon::now()
        ])->save();
    }
}
