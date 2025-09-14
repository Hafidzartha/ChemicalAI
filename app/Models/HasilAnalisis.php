<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAnalisis extends Model
{
    protected $table = 'hasil_analisis';
    protected $fillable = [
        'id_user',
        'video_path',
        'analisis_mode',
        'array_param',
        'hasil_analisis',
        'graf',
        'durasi',
        'akurasi',
        'data_point',
        'interpretasi',
        'rekomendasi',
        'status',
        'regression_results',
        'half_life',
    ];

    protected $casts = [
        'array_param' => 'array',
        'hasil_analisis' => 'string',
        'graf' => 'array',
        'durasi' => 'float',
        'akurasi' => 'float',
        'data_point' => 'array',
        'interpretasi' => 'string',
        'rekomendasi' => 'array',
        'regression_results' => 'array',
        'half_life' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
