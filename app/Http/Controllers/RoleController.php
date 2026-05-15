<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequeest;
use App\Http\Requests\UpdateRoleRequeest;
use App\Models\RoleModel;
use App\Services\CrudService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected RoleModel $roleModel;
    protected CrudService $roleCrudService;

    public function __construct() {
        $this->roleCrudService = new CrudService(new roleModel);
    }

    /**
     * Role List
     *
     * @return JsonResponse
     */
    public function roleList() : JsonResponse
    {
       try {
            $data = $this->roleCrudService->retrieve();
            return $this->sucessResponse('Success',[
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Create new Role
     *
     * @param  StoreRoleRequeest $request
     * @return JsonResponse
     */
    public function roleCreate(StoreRoleRequeest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $create =  $this->roleCrudService->create($data);
            return $this->sucessResponse('Success',['data' => $create ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Update Role
     *
     * @param  UpdateRoleRequeest $request
     * @param  RoleModel $role
     * @return JsonResponse
     */
    public function roleUpdate(UpdateRoleRequeest $request,RoleModel $role) : JsonResponse
    {
        try {
            $data = $request->validated();
            return $this->sucessResponse('Successfully Updated', [
                'data' => $this->roleCrudService->update($role,$data)
            ]);
            //code...
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Delete role
     *
     * @param  RoleModel $role
     * @return JsonResponse
     */
    public function roleDelete(RoleModel $role) : JsonResponse
    {
        try {
            $delete = $this->roleCrudService->delete($role);
            return $this->sucessResponse('Successfully deleted.');
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
}
