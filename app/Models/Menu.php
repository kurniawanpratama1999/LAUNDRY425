<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'icon',
        'name',
        'link',
    ];

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_menus', 'menu_id', 'level_id');
    }
}
