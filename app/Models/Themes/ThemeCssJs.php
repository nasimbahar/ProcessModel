<?php

namespace App\Models\Themes;

use Illuminate\Database\Eloquent\Model;

class ThemeCssJs extends Model
{
    protected $table = 'theme_css_jss';
      public function themresource()
    {
        return $this->belongsTo(ThemeResourceType::class, 'resource_type_id');
    }
      public function themeid()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
    public function themecssjs(){
        return $this->hasMany(ThemeCssJs::class, 'theme_id');
    }
    
}
