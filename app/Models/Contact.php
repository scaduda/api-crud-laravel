<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';
    protected $table = 'contacts';
    protected $fillable = [
        'people_id',
        'email',
        'phone_number'
    ];
    protected $visible = [
        'id',
        'people_id',
        'email',
        'phone_number'
    ];

    public function people()
    {
        return $this->hasOne(People::class, 'id', 'people_id');
    }
}
