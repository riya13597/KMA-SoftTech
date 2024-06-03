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
            ->where('users.id', $id)
            ->first();
    }

    /**
     * @param array $ids
     * @return boolean
     */
    public static function createData(array $req, array $ids): bool
    {
        $ids = implode(',', $ids);
        $idsJson = json_encode($ids);
        return self::insert(['name' => $req['name'], 'skill_id' => $ids]);
    }

    /**
     * @param string $id
     * @param Request $req
     * @return mixed
     */
    public static function updateData(string $id, Request $req): mixed
    {
        $id = [];
        foreach ($req->skills as $skill) {
            $id[] = Skill::getId(($skill));
        }
        $skillData = implode(',', $id);

        return self::where('id', $id)->update([
            'name' => $req->name,
            'skill_id' => $skillData,
        ]);
    }

}
