<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

    protected $table = 'skills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public static function getId(string $skill)
    {
        return self::where('name', $skill)->pluck('id')->first();
    }

    public static function getSkill(string $id)
    {
        return self::where('id', $id)->pluck('name')->first();
    }

}
