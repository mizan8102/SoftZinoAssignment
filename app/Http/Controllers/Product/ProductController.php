<?php

namespace App\Http\Controllers\Product;

use App\Enums\ApiResponseEnum;
use App\Enums\HttpStatusCodeEnum;
use App\Http\ApiResponse\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Repositories\Eloquent\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $productRepository;

    use ApiResponseTrait;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "sort" => request("sort", false),
            "filter" => request("filter", ""), // filter by category
        ];
        $res = $this->productRepository->index($data);
        if ($res) {
            return $this->successResponse($res, "Data retrive");
        } else {
            return $this->errorResponse("retrive failed", HttpStatusCodeEnum::BAD_REQUEST);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $productRequest)
    {
        $data = $productRequest->validated();
        $res = $this->productRepository->store($data);
        if ($res["status"] == ApiResponseEnum::SUCCESS) {
            return $this->successResponse($res, "Stored successfull");
        } else {
            return $this->errorResponse($res, HttpStatusCodeEnum::BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
