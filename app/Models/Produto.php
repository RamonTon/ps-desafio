<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produto extends Model
{
    protected $table  = 'produtos';
    protected $fillable = [
        'nome','preco','descricao','quantidade','imagem','categoria_id'
    ];


    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function getTitleShortAttribute(){
        return Str::limit($this->descricao ?? '', 30 , '...');
    }
}

