<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

interface BaseContract
{
    public function create(array $params) : Model | Collection | array;
    public function retrieve( bool $addPagination, int $per_page , int $page) : LengthAwarePaginator | Collection | array ;
    public function update(Model $updateModel , array $updateArray) : Model | Collection | array;
    public function delete(Model $deleteModel) : Collection | array | bool;
}
