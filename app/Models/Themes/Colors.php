<?php

namespace App\Models\Themes;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $table = 'colors';
    
       public function getOptionsAttribute($options)
    {
        if (is_string($options)) {
            $options = explode(',', $options);
        }

        return $options;
    }

    public function setOptionsAttribute($options)
    {
        if (is_array($options)) {
            $options = join(',', $options);
        }

        $this->options = $options;
    }
}
