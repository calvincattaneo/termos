<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $fillable = ['user_id', 'solicitante', 'destino', 'data_retirada', 'data_prevista_entrega', 'data_entrega'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function itemEmprestimo()
    {
        return $this->hasMany(ItemEmprestimo::class);
    }
}
