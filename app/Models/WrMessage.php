<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrMessage extends Model
{
    use HasFactory;

    protected $table = 'wr_message';

    protected $primaryKey = 'message_id';

    public $timestamps = false;

    protected $fillable = [
        'subject',
        'message',
    ];

    public function glues()
    {
        return $this->hasMany(WrMessageGlue::class, 'message_id');
    }
}
