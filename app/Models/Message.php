<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $primaryKey = 'message_id';

    public $timestamps = false;

    protected $fillable = [
        'subject',
        'message',
    ];

    public function glues()
    {
        return $this->hasMany(MessageGlue::class, 'message_id');
    }
}
