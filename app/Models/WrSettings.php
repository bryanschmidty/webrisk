<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrSettings extends Model
{
    use HasFactory;

    protected $table = 'wr_settings';

    protected $primaryKey = 'setting';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'setting',
        'value',
        'notes',
        'sort',
    ];
}
