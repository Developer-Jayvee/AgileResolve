<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
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
