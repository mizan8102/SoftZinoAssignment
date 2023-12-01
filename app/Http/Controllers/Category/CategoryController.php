<?php

namespace App\Http\Controllers\Category;

use App\Enums\HttpStatusCodeEnum;
use App\Http\ApiResponse\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepositoryInterface;

    use ApiResponseTrait;
    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = $this->categoryRepositoryInterface->index();
        if ($res) {
            return $this->successResponse($res, "Data retrive");
        } else {
            return $this->errorResponse("retrive failed", HttpStatusCodeEnum::BAD_REQUEST);
        }
    }
}
