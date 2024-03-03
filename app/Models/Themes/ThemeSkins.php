<?php

namespace App\Models\Themes;

use Illuminate\Database\Eloquent\Model;

class ThemeSkins extends Model
{
    protected $table = 'theme_skins';
    
    public function color()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }
     public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
