<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'breed', 'age', 'weight', 'city', 'fk_user_id'];

    /**
     * Generate cutted link
     *
     * @param string $url
     * @return array $response
     */
    public static function getPet(Request $request) : array
    {
        $pet = self::where('city', $url)->count();

        $duplicated = self::checkDuplicate($url);

        if($duplicated) {
            do {
                $url = self::regenerate($url);
            }while(self::checkDuplicate($url));
        }

        //Time to expire
        $time_to_expire = Carbon::now()->addMinutes(self::TIME_TO_EXPIRE);
        $expire = date('Y-m-d H:i:s', strtotime($time_to_expire));

        $url_cutted = self::create([
            'url_target' => $url_target,
            'cuted_url' => $url,
            'date_expire' => $expire
        ]);

        $response = [
            'target_url' => $url_target,
            'cuted_url' => $url,
            'status' => 200
        ];

        return $response;
    }

    /**
     * Check if has duplication
     *
     * @param string $url
     * @return bool
     */
    public static function checkDuplicate(string $url) : bool
    {
        $duplicated = self::where('cuted_url', $url)->count();

        return boolval($duplicated);
    }

    public static function prepare_url(string $url) : string
    {
        $url = str_replace("http://", "", $url);
        $url = str_replace("https://", "", $url);

        $url = urldecode($url);

        return $url;
    }

    /**
     * generate other if has equal in DB
     *
     * @param string $url
     * @return string $new_url
     */
    public static function regenerate($url) : string
    {
        $number = rand(0, 999);

        $new_url = substr($url, 0, 7) . $number;

        return $new_url;
    }
}
