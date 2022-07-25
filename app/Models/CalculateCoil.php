<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculateCoil extends Model
{
    use HasFactory;

    protected $fillable = [
        'loole_messi', 'fin_coil', 'tedad_radif_coil', 'fin_dar_inch', 'kham', 'tedad_madar_coil', 'zekhamat_frame_coil',
        'pooshesh_khordegi', 'collector_ahani', 'collector_messi', 'collector_berenji', 'toole_coil', 'tedad_loole_dar_radif',
        'tedad_madar_loole', 'tedad_soorakh_pakhshkon', 'price', 'inquiry_id', 'type', 'tedad_mogheyiat_loole',
    ];
}
