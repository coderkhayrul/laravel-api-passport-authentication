<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthentcateContract;


class Author extends Model implements AuthentcateContract
{
    use HasFactory, HasApiTokens, Authenticatable;

    public $timestamps = false;

    protected $fillable =
    [
        'name',
        'email',
        'password',
        'phone_no'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
