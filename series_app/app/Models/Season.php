<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];
    public $timestamps = false;
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getWatchedEpisodes(): Collection
    {
        return $this->episodes->filter(function (Episode $episode) {
            return $episode->watched;
        });
    }
}
