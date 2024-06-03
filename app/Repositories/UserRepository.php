<?php

namespace App\Repositories;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserRepository
{

    /**
     * @return Collection
     */
    public function getUser(): Collection
    {
        $userData = User::getAllData();
        foreach ($userData as $data) {
            $ids = explode(',', $data->skill_id);
            $skills = [];
            foreach ($ids as $id) {
                $skills[] = Skill::getSkill($id);
            }
            $data->skills = $skills;
        }
        return $userData;
    }

    /**
     * @param Request $request
     * @return boolean
     */
    public function saveData(Request $request): bool
    {
        $skillsData = [];
        $skills = $request->skillsInput;
        $ids = explode(',', $skills);
        foreach ($ids as $id) {

            $skillsData[] = Skill::getId($id);
        }
        $userData = User::createData($request->post(), $skillsData);
        return $userData;
    }

    /**
     * @param string $id
     * @return User
     */
    public function editData(string $id): User
    {
        $userData = User::getDataById($id);
        $ids = explode(',', $userData->skill_id);
        $skills = [];
        foreach ($ids as $id) {
            $skills[] = Skill::getSkill($id);
        }
        $userData->skills = $skills;
        return $userData;
    }

    /**
     * @param string $id
     * @param Request $request
     * @return void
     */
    public function updateData(string $id, Request $request): void
    {
        User::updateData($id, $request);
    }
}
