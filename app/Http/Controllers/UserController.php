<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\CrudService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;

    protected CrudService $userCrudService;


    public function __construct() {
        $this->userCrudService = new CrudService(new User);
    }

    /**
     * User List
     *
     * @return JsonResponse
     */
    public function userList() : JsonResponse
    {
       try {
            $data = $this->userCrudService->retrieve();
            return $this->sucessResponse('Success',[
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Create new user
     *
     * @param  StoreUserRequest $request
     * @return JsonResponse
     */
    public function userCreate(StoreUserRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $create =  $this->userCrudService->create($data);
            return $this->sucessResponse('Success',['data' => $create ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Update user
     *
     * @param  UpdateUserRequest $request
     * @param  User $user
     * @return JsonResponse
     */
    public function userUpdate(UpdateUserRequest $request,User $user) : JsonResponse
    {
        try {
            $data = $request->validated();
            return $this->sucessResponse('Successfully Updated', [
                'data' => $this->userCrudService->update($user,$data)
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Delete user
     *
     * @param  User $user
     * @return JsonResponse
     */
    public function userDelete(User $user) : JsonResponse
    {
        try {
            $delete = $this->userCrudService->delete($user);
            return $this->sucessResponse('Successfully deleted.');
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
}
