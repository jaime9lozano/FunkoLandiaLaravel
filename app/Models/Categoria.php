<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
    use HasFactory;

    public static $NOMBRES_VALIDOS=['DISNEY','MARVEL','SERIES','OTROS'];

    protected $table = 'categorias';
    protected $fillable=['nombre'];

    public static function findByName(string $name){
        return self::where('nombre',$name)->first();
    }
    public function funkos()
    {
        return $this->hasMany(Funko::class);
    }
}
