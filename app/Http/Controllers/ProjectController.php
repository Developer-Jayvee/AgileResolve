<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ProjectModel;
use App\Services\CrudService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Override;

class ProjectController extends ResourceController
{
    #[Override]
    public function setParams()
    {
        $this->mainModel = new ProjectModel();
        $this->storeRequest = new StoreProjectRequest;
        $this->updateRequest = new UpdateProjectRequest;
    }
}
