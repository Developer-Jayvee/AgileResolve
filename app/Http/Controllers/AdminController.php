<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ProjectModel;
use App\Services\CrudService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Override;

class AdminController extends Controller
{
    protected ProjectModel $projectModel;
    protected CrudService $projectCrudService;

    public function __construct() {
        $this->projectCrudService = new CrudService(new ProjectModel);
    }

    /**
     * Project List
     *
     * @return JsonResponse
     */
    public function projectList() : JsonResponse
    {
        return $this->projectCrudService->retrieve();
    }
    /**
     * Create new Project
     *
     * @param  StoreProjectRequest $request
     * @return JsonResponse
     */
    public function projectCreate(StoreProjectRequest $request) : JsonResponse
    {
        $data = $request->validated();
        return $this->projectCrudService->create($data);
    }
    /**
     * Update Project
     *
     * @param  UpdateProjectRequest $request
     * @param  ProjectModel $project
     * @return JsonResponse
     */
    public function projectUpdate(UpdateProjectRequest $request,ProjectModel $project) : JsonResponse
    {
        $data = $request->validated();
        return $this->projectCrudService->update($project,$data);
    }
    /**
     * Delete Project
     *
     * @param  ProjectModel $project
     * @return JsonResponse
     */
    public function projectDelete(ProjectModel $project) : JsonResponse
    {
        return $this->projectCrudService->delete($project);
    }
}
