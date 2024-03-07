<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'description',
        'id_image',
        'created_by',
        'price',
        'nombre_place',
        'ville_id',
        'deadline',
        'category_id',
        'acceptation',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(Lieu::class, 'ville_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
