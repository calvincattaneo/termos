<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemEmprestimo extends Model
{
    protected $fillable = ['emprestimo_id', 'descricao', 'entregue'];

    public function emprestimo()
    {
        return $this->belongsTo(ItemEmprestimo::class);
    }
}
