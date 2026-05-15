<?php

namespace App\Http\Controllers;

use App\Services\CrudService;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ResourceController
{
    use ResponseTrait;

    protected Model $mainModel;
    protected FormRequest $storeRequest;
    protected FormRequest $updateRequest;

    protected CrudService $crudService;

    protected bool $hasPagination = false;
    protected int $perPage = 10;
    protected int $pageIndex = 1;


    abstract protected function setParams();

    public function __construct() {
        $this->setParams();

        $this->crudService = new CrudService($this->mainModel);
    }
    /**
     * Index
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        try {
            $data = $this->crudService->retrieve($this->hasPagination,$this->perPage,$this->pageIndex);
            return $this->sucessResponse('Success',[
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Create
     *
     * @param  FormRequest $request
     * @return JsonResponse
     */
    public function store(FormRequest $request) : JsonResponse
    {
        try {
            $storeRequest = app($this->storeRequest::class);
            $data = $storeRequest->validated();

            $create =  $this->crudService->create($data);
            return $this->sucessResponse('Success',['data' => $create ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Update
     *
     * @param  FormRequest $request
     * @param  int $id
     * @return JsonResponse
     */
    public function update(FormRequest $request, $id) : JsonResponse
    {
        try {

            $storeRequest = app($this->updateRequest::class);
            $data = $storeRequest->validated();
            $mainModel = $this->mainModel->find($id);
            if(!$mainModel) throw new \Exception("Data does not exists.", 422);

            return $this->sucessResponse('Successfully Updated', [
                'data' => $this->crudService->update($mainModel,$data)
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    /**
     * Delete
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function destroy( $id) : JsonResponse
    {
        try {
            $mainModel = $this->mainModel->find($id);
            if(!$mainModel) throw new \Exception("Data does not exists.", 422);
            $mainModel->delete();
            return $this->sucessResponse('Successfully deleted.');
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
}
