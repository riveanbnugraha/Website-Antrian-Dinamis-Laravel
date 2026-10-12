<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuweb extends Model
{
    use HasFactory;

    protected $table = 'tuwebs'; // nama tabel di database
    protected $fillable = ['nama', 'jadwal'];
}
