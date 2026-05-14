<?php

namespace App\Services;

use App\Contracts\BaseContract;
use App\Services\CrudService;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;
use Override;

abstract class BaseService implements BaseContract
{
    use ResponseTrait;


    protected Model $baseModel;
    protected Request $updateRequest;


    protected int $itemId;


    abstract protected function setParams();

    public function __construct() {

    }

    #[Override]
    /**
     * Create
     *
     * @param  array $store
     * @param  string $message
     * @return JsonResponse
     */
    public function create( $store = array(),string $message = "Successfully Stored.") : JsonResponse
    {
        try {
            if(count($store) === 0) throw new \Exception("Missing payload", 500);

            $data = $this->baseModel->create($store);
            return $this->sucessResponse($message,['data' => $data ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th,500);
        }
    }
    /**
     * Retrieve
     *
     * @param  bool $addPagination
     * @param  int $per_page
     * @param  int $page
     * @return JsonResponse
     */
    public function retrieve(bool $addPagination = false ,int $per_page = 10 , int $page = 1) : JsonResponse
    {
        try {
            if($addPagination){
                $data = new LengthAwarePaginator(
                    collect($this->baseModel->get()),
                    $this->baseModel->count(),
                    $per_page,
                    $page
                );
                return $this->sucessResponse("Success",[
                    'data' => $data
                ]);
            }
            return $this->sucessResponse("Success",[
                'data' => $this->baseModel->get()
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    #[Override]
    /**
     * Update
     *
     * @param  Model $updateModel
     * @param  array $updateArray
     * @return JsonResponse
     */
    public function update(Model $updateModel , array $updateArray = array()) : JsonResponse
    {
        try {
            $data =  $updateModel->update($updateArray);
            return $this->sucessResponse("Updated Successfully" , [
                'data' => $updateModel
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
    #[Override]
    /**
     * Delete
     *
     * @param  Model $deleteModel
     * @return JsonResponse
     */
    public function delete(Model $deleteModel) : JsonResponse
    {
         try {
            $data =  $deleteModel->delete();
            return $this->sucessResponse("Deleted Successfully");
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
}
