<?php

namespace App\Services;

use App\Contracts\CrudContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;
use Override;

class CrudService extends BaseService
{
    public Model $crudModel;
    public function __construct(Model $crudModel) {
        $this->baseModel = $crudModel;
    }

    #[Override]
    public function setParams()
    {

    }
}
