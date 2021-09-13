<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model {

  use HasFactory;

  protected $table = 'notas';

  protected $primaryKey = 'id';

  protected $fillable = [
    'nota',
    'data_nota',
    'nome_destino',
    'email_destino',
    'cpf_destino',
    'rua_destino',
    'num_destino',
    'bairro_destino',
    'municipio_destino',
    'uf_destino',
    'cep_destino',
    'total_nota',
    'user_id'
  ];

}
