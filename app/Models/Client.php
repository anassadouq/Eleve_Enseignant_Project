<?php

namespace App\Models;

use App\Models\Magasin;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
        'tel'
    ];

    public function magasins()
    {
        return $this->hasMany(Magasin::class, 'id_client');
    }
}