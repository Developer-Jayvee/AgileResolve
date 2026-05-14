<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

interface BaseContract
{
    public function create(array $params) : JsonResponse;
    public function retrieve( bool $addPagination, int $per_page , int $page) : JsonResponse;
    public function update(Model $updateModel , array $updateArray) : JsonResponse;
    public function delete(Model $deleteModel) : JsonResponse;
}
