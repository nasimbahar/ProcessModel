<?php

namespace App\Models\Themes;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';
     protected $casts = [
        'extra' => 'json',
    ];
    public function cateogry()
    {
        return $this->belongsTo(ThemeCategories::class, 'category_id');
    }
      public function skins()
    {
        return $this->morphToMany(Colors::class,'theme', 'theme_skins');
    }
    public function themeparts(){
        return $this->hasMany(ThemeParts::class, 'theme_id');
    }
    public function themecss(){
        return $this->hasMany(ThemeCssJs::class, 'theme_id')->where("resource_type_id",1);
    }
    public function themejs(){
        return $this->hasMany(ThemeCssJs::class, 'theme_id')->where("resource_type_id",2);
    }
      public function theme_featurs()
    {
        return $this->hasMany(ThemeFeatures::class, 'theme_id');
    }
}
