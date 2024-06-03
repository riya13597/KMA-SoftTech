<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @param UserRepository $userRepo
     */
    public function __construct(protected UserRepository $userRepo)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $userData = $this->userRepo->getUser();
        return response()->json($userData);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $userData = $this->userRepo->saveData($request);
        return response()->json([
            'message' => 'userData Created Successfully!!',
            'category' => $userData,
        ]);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function edit(string $id): JsonResponse
    {
        $userData = $this->userRepo->editData($id);
        return response()->json($userData);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(string $id, Request $request): JsonResponse
    {
        $this->userRepo->updateData($id, $request);
        return response()->json('UserData Updated!');
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([
            'message' => 'User Data Deleted Successfully!!',
        ]);
    }
}
