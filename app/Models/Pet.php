<?php

namespace App\Models;

use App\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'breed', 'age', 'weight', 'city', 'fk_user_id'];

    /**
     * @return array
     */
    public static function getPets()
    {
        //check if user is logged and get pet by your city
        if (!empty(auth()->user())) {
            $city = Address::where('fk_user_id', auth()->user()->id)->pluck('city');
            return self::getPetsByCity($city[0]);
        }
        return self::getAllPets();
    }

    /**
     * get pets by city with user email
     * @param $city
     * @return array
     */
    public static function getPetsByCity($city)
    {
        return DB::select("
            SELECT
                p.*,
                u.email
            FROM
                pet p
            INNER JOIN
                users u ON u.id = p.fk_user_id
            WHERE
                p.city = :city",
            [
                'city' => $city,
            ]
        );
    }

    /**
     * Get all pets with user email
     * @return array
     */
    public static function getAllPets()
    {
        return DB::select("
            SELECT
                p.*,
                u.email
            FROM
                pet p
            INNER JOIN
                users u ON u.id = p.fk_user_id
            "
        );
    }
}
