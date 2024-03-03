<?php

namespace App\Models\Themes;

use Illuminate\Database\Eloquent\Model;

class ThemeParts extends Model
{
    protected $table = 'theme_parts';
       public function themeid()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
    public function themeparts(){
        return $this->hasMany(ThemeParts::class, 'theme_id');
    }
    
}
