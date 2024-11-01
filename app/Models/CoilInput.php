<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoilInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'loole_messi', 'fin_coil', 'tedad_radif_coil', 'fin_dar_inch', 'zekhamat_frame_coil', 'pooshesh_khordegi',
        'collector_ahani', 'collector_messi', 'electrod_noghre', 'noe_coil', 'toole_coil', 'tedad_loole_dar_radif',
        'tedad_mogheyiat_loole', 'tedad_madar_loole', 'kham', 'tedad_madar_coil', 'tedad_soorakh_pakhshkon', 'sathe_coil',
        'type', 'part_id', 'inquiry_id', 'contract_id'
    ];
}
