<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageGlue extends Model
{
    use HasFactory;

    protected $table = 'message_glues';

    protected $primaryKey = 'message_glue_id';

    public $timestamps = false;

    protected $fillable = [
        'message_id',
        'from_id',
        'to_id',
        'send_date',
        'expire_date',
        'view_date',
        'deleted',
    ];

    protected $casts = [
        'send_date' => 'datetime',
        'expire_date' => 'datetime',
        'view_date' => 'datetime',
        'deleted' => 'boolean',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }

    public function fromPlayer()
    {
        return $this->belongsTo(Player::class, 'from_id');
    }

    public function toPlayer()
    {
        return $this->belongsTo(Player::class, 'to_id');
    }
}
