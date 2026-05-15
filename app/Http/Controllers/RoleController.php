<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequeest;
use App\Http\Requests\UpdateRoleRequeest;
use App\Models\RoleModel;
use App\Services\CrudService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Override;

class RoleController extends ResourceController
{

    #[Override]
    public function setParams()
    {
        $this->mainModel = new RoleModel;
        $this->storeRequest = new StoreRoleRequeest;
        $this->updateRequest = new UpdateRoleRequeest;
    }
}
