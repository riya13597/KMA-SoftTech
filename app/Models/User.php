<?php

namespace App\Models;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class User extends Model
{

    protected $fillable = [
        'name',
        'skill_id',
    ];

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @return void
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    /**
     * @return Collection
     */
    public static function getAllData(): Collection
    {
        return self::select(['id', 'name', 'skill_id'])
            ->get();
    }

    /**
     * @param string $id
     * @return mixed
     */
    public static function getDataById(string $id): mixed
    {
        return self::select(['id', 'name', 'skill_id'])
            ->with('skill')
            ->where('users.id', $id)
            ->first();
    }

    /**
     * @param array $req
     * @param integer $id
     * @return boolean
     */
    public static function createData(array $req, int $id): bool
    {
        return self::insert(['name' => $req['name'], 'skill_id' => $id]);
    }

    /**
     * @param string $id
     * @param Request $req
     * @param string $skilId
     * @return mixed
     */
    public static function updateData(string $id, Request $req, string $skilId): mixed
    {
        return self::where('id', $id)->update([
            'name' => $req->name,
            'skill_id' => $skilId,
        ]);
    }

}
