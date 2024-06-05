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
        $userData = User::with('skill')->get();
        return $userData;
    }

    /**
     * @param Request $request
     * @return boolean
     */
    public function saveData(Request $request): bool
    {
        $skillId = Skill::getId($request->skillsInput);
        $userData = User::createData($request->post(), $skillId);
        return $userData;
    }

    /**
     * @param string $id
     * @return User
     */
    public function editData(string $id): User
    {
        $userData = User::getDataById($id);
        return $userData;
    }

    /**
     * @param string $id
     * @param Request $request
     * @return void
     */
    public function updateData(string $id, Request $request): void
    {
        $skillId = Skill::getId($request->skill['name']);
        User::updateData($id, $request, $skillId);
    }
}
