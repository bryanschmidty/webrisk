<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrGameLog extends Model
{
    use HasFactory;

    protected $table = 'wr_game_log';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'game_id',
        'data',
        'create_date',
        'microsecond',
    ];

    protected $casts = [
        'create_date' => 'datetime',
    ];

    public function game()
    {
        return $this->belongsTo(WrGame::class, 'game_id');
    }
}
