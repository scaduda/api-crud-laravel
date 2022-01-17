<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';
    protected $table = 'people';
    protected $fillable = [
        'name',
        'cpf'
    ];
    protected $visible = [
        'id',
        'name',
        'cpf',
        'contact'
    ];

    public function contact()
    {
      return $this->hasMany(Contact::class);
    }
}
