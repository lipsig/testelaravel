<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Classe Student que estende a classe Model
class Student extends Model
{
    // Trait para usar a factory do Laravel
    use HasFactory;

    // Propriedade protegida para definir os campos que podem ser preenchidos em massa
    protected $fillable = ['name', 'email'];
}
?>