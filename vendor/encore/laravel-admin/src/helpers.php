<?php

use App\Models\Packagess;
use App\Models\PackagesTypes;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\MessageBag;
use KevinSoft\MultiLanguage\MultiLanguage;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('admin_path')) {

    /**
     * Get admin path.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_path($path = '')
    {
        return ucfirst(config('admin.directory')).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('admin_url')) {
    /**
     * Get admin url.
     *
     * @param string $path
     * @param mixed  $parameters
     * @param bool   $secure
     *
     * @return string
     */
    function admin_url($path = '', $parameters = [], $secure = null)
    {
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }

        $secure = $secure ?: (config('admin.https') || config('admin.secure'));

        return url(admin_base_path($path), $parameters, $secure);
    }
}

if (!function_exists('table_footer')) {

    function table_footer($label,$data)
    {
      return  "<td style='padding: 10px; margin:20px'>".$label.": <small class='label bg-blue'>  $data</small></td>     ";
    }
}


if (!function_exists('getRecvibaleAccount')) {

    function getRecvibaleAccount($currecny)
    {
         if($currecny==3){
            return 209;
        
        }else if($currecny==144){
            return 242;
        }
    }
}

if (!function_exists('getfinancilyear')) {

    function getfinancilyear()
    {
     $compnay_id=  Encore\Admin\Facades\Admin::user()->company_id;
     return   Illuminate\Support\Facades\DB::table("financial_year")->where("iscompleted",0)->where("company_id",$compnay_id)->first()->id;
    }
}

if (!function_exists('getPayableAccount')) {

    function getPayableAccount($currecny)
    {
        if($currecny==3){
            return 207;
        
        }else if($currecny==144){
            return 240;
        }
    }
}
if (!function_exists('admin_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_base_path($path = '')
    {
        $prefix = '/'.trim(config('admin.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix.'/'.$path;
    }
}

if (!function_exists('admin_toastr')) {

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     */
    function admin_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new MessageBag(get_defined_vars());

        session()->flash('toastr', $toastr);
    }
}

if (!function_exists('admin_success')) {

    /**
     * Flash a success message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_success($title, $message = '')
    {
        admin_info($title, $message, 'success');
    }
}

if (!function_exists('admin_error')) {

    /**
     * Flash a error message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_error($title, $message = '')
    {
        admin_info($title, $message, 'error');
    }
}

if (!function_exists('admin_warning')) {

    /**
     * Flash a warning message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_warning($title, $message = '')
    {
        admin_info($title, $message, 'warning');
    }
}

if (!function_exists('admin_info')) {

    /**
     * Flash a message bag to session.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     */
    function admin_info($title, $message = '', $type = 'info')
    {
        $message = new MessageBag(get_defined_vars());

        session()->flash($type, $message);
    }
}

if (!function_exists('admin_asset')) {

    /**
     * @param $path
     *
     * @return string
     */
    function admin_asset($path)
    {
        return (config('admin.https') || config('admin.secure')) ? secure_asset($path) : asset($path);
    }
}
if (!function_exists('calculate_expriation_date')) {

    function calculate_expriation_date($id=1,$date=null)
    {
        $days=PackagesTypes::where('id',$id)->get()->first()->days;
        if($date==null) {
            $date = date("Y-m-d");
        }
        return date('Y-m-d',strtotime($date."+ ".$days." days"));
    }
}


if (!function_exists('days_between_two_dates')) {

    /**
     * @param $path
     *
     * @return string
     */
    function days_between_two_dates($date1=null,$date2)
    {
        if($date1==null) {
            $date1 = new DateTime(date("Y-m-d"));
        }
        return $date1->diff($date2)->format("%r%a");
    }
}
if (!function_exists('remaining_days')) {

    function remaining_days()
    {
        if(!Admin::user()->isRole('administrator')) {
            $school_id = Admin::user()->school_id;
            $expiration_date = Packagess::where("school_id", $school_id)->get()->first()->expire_date;
            $expiration_date = new \DateTime($expiration_date);
            return days_between_two_dates(null, $expiration_date);
        }
        else{

        }


    }
}
if (!function_exists('is_expired')) {

    function is_expired()
    {
        if(!Admin::user()->isRole('administrator')) {
            $school_id = Admin::user()->school_id;
            $expiration_date = Packagess::where("school_id", $school_id)->get()->first()->expire_date;
            $expiration_date = new \DateTime($expiration_date);
            if (days_between_two_dates(null, $expiration_date) < 1) {
                return true;

            }
        }
        return false;
    }
}
if (!function_exists('some_error')) {

    function some_error($msg)
    {
        $html='<br><div class="alert alert-danger alert-dismissible" style="margin:10px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>'.$msg.'
               <span data-toggle="tooltip" title="" class="badge bg-red" data-original-title="3 New Messages">3</span>
              </div>';
        return $html;
    }
}
if (!function_exists('tooltip_msg')) {

    function tooltip_msg($text="",$title="",$color="red")
    {
        $html='
               <span data-toggle="tooltip" title="" class="badge bg-'.$color.'" data-original-title="'.$title.'">'.$text.'</span>
              ';
        return $html;
    }
}




if (!function_exists('admin_trans')) {

    /**
     * Translate the given message.
     *
     * @param string $key
     * @param array  $replace
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function admin_trans($key = null, $replace = [], $locale = null)
    {
        $line = __($key, $replace, $locale);

        if (!is_string($line)) {
            return $key;
        }

        return $line;
    }
}

if (!function_exists('array_delete')) {

    /**
     * Delete from array by value.
     *
     * @param array $array
     * @param mixed $value
     */
    function array_delete(&$array, $value)
    {
        foreach ($array as $index => $item) {
            if ($value == $item) {
                unset($array[$index]);
            }
        }
    }
}

if (!function_exists('class_uses_deep')) {

    /**
     * To get ALL traits including those used by parent classes and other traits.
     *
     * @param $class
     * @param bool $autoload
     *
     * @return array
     */
    function class_uses_deep($class, $autoload = true)
    {
        $traits = [];

        do {
            $traits = array_merge(class_uses($class, $autoload), $traits);
        } while ($class = get_parent_class($class));

        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait, $autoload), $traits);
        }

        return array_unique($traits);
    }
}

if (!function_exists('admin_dump')) {

    /**
     * @param $var
     *
     * @return string
     */
    function admin_dump($var)
    {
        ob_start();

        dump(...func_get_args());

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}

if (!function_exists('file_size')) {

    /**
     * Convert file size to a human readable format like `100mb`.
     *
     * @param int $bytes
     *
     * @return string
     *
     * @see https://stackoverflow.com/a/5501447/9443583
     */
    function file_size($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2).' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2).' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2).' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes.' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes.' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

if (!function_exists('prepare_options')) {

    /**
     * @param array $options
     *
     * @return array
     */
    function prepare_options(array $options)
    {
        $original = [];
        $toReplace = [];

        foreach ($options as $key => &$value) {
            if (is_array($value)) {
                $subArray = prepare_options($value);
                $value = $subArray['options'];
                $original = array_merge($original, $subArray['original']);
                $toReplace = array_merge($toReplace, $subArray['toReplace']);
            } elseif (strpos($value, 'function(') === 0) {
                $original[] = $value;
                $value = "%{$key}%";
                $toReplace[] = "\"{$value}\"";
            }
        }

        return compact('original', 'toReplace', 'options');
    }
}

if (!function_exists('json_encode_options')) {

    /**
     * @param array $options
     *
     * @return string
     *
     * @see http://web.archive.org/web/20080828165256/http://solutoire.com/2008/06/12/sending-javascript-functions-over-json/
     */
    function json_encode_options(array $options)
    {
        $data = prepare_options($options);

        $json = json_encode($data['options']);

        return str_replace($data['toReplace'], $data['original'], $json);
    }
}

if(!function_exists('getlocale')){
    
    function getlocale(){
       
        $current = MultiLanguage::config('default');
        if(Cookie::has("locale")) {
            $current = Cookie::get("locale");
        }
        return $current;
    }
}