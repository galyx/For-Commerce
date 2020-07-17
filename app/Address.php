<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'cep', 'uf', 'cidade', 'bairro', 'rua', 'numero', 'complemento',
    ];
}
