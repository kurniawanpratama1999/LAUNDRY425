<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'level_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'level_menus', 'level_id', 'menu_id');
    }
}
