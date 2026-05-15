<?php

namespace App\Services;

use App\Contracts\BaseContract;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Collection;
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

    abstract protected function setParams();

    public function __construct() { }

    #[Override]
    /**
     * Create
     *
     * @param  array $store
     * @param  string $message
     * @return Collection | array
     */
    public function create( $store = array(),string $message = "Successfully Stored.") : Model |  Collection | array
    {
        try {
            if(count($store) === 0) throw new \Exception("Missing payload", 500);
            return $this->baseModel->create($store);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     * Retrieve
     *
     * @param  bool $addPagination
     * @param  int $per_page
     * @param  int $page
     * @return Collection | array
     */
    public function retrieve(bool $addPagination = false ,int $per_page = 10 , int $page = 1) : LengthAwarePaginator | Collection | array
    {
        try {
            if($addPagination){
                $data = new LengthAwarePaginator(
                    collect($this->baseModel->get()),
                    $this->baseModel->count(),
                    $per_page,
                    $page
                );
                return $data;
            }
           return $this->baseModel->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    #[Override]
    /**
     * Update
     *
     * @param  Model $updateModel
     * @param  array $updateArray
     * @return Collection | array
     */
    public function update(Model $updateModel , array $updateArray = array()) : Model | Collection | array
    {
        try {
            $update = $updateModel->update($updateArray);
            return $updateModel;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    #[Override]
    /**
     * Delete
     *
     * @param  Model $deleteModel
     * @return Collection | array | bool
     */
    public function delete(Model $deleteModel) : Collection | array |  bool
    {
         try {
            return  $deleteModel->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
