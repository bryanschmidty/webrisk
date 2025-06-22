<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrMessageGlue extends Model
{
    use HasFactory;

    protected $table = 'wr_message_glue';

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
        return $this->belongsTo(WrMessage::class, 'message_id');
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
