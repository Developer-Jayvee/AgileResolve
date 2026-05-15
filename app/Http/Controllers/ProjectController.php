<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ProjectModel;
use App\Services\CrudService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    use ResponseTrait;

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
        try {
            $data = $this->projectCrudService->retrieve();
            return $this->sucessResponse('Success',[
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Create new Project
     *
     * @param  StoreProjectRequest $request
     * @return JsonResponse
     */
    public function projectCreate(StoreProjectRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $create =  $this->projectCrudService->create($data);
            return $this->sucessResponse('Success',['data' => $create ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
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
        try {
            $data = $request->validated();
            return $this->sucessResponse('Successfully Updated', [
                'data' => $this->projectCrudService->update($project,$data)
            ]);
            //code...
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Delete Project
     *
     * @param  ProjectModel $project
     * @return JsonResponse
     */
    public function projectDelete(ProjectModel $project) : JsonResponse
    {
        try {
            $delete = $this->projectCrudService->delete($project);
            return $this->sucessResponse('Successfully deleted.');
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
}
