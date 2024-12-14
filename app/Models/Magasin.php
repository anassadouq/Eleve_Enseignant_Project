<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    protected $fillable = ['lieu'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}