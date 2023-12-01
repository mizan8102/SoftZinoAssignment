<?php

namespace App\Services\Product;

use App\DTOs\ProductDTO\ProductDTO;
use App\Enums\ApiResponseEnum;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Eloquent\Product\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductService implements ProductRepositoryInterface
{


    //
    public function index(array $data)
    {
        $sort = $data["sort"] ?? false;
        $filter_id = $data["filter"] ?? "";

        try {
            $query = Product::with(['categories', 'images']);

            if ($filter_id) {
                $query->whereHas('categories', function ($query) use ($filter_id) {
                    $query->where('id', $filter_id);
                });
            }

            if ($sort) {
                $query->orderBy('price', 'desc');
            }

            $products = $query->get();
            return $products;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(array $data): array
    {
        try {
            DB::beginTransaction();
            $product = new ProductDTO($data);
            $res = Product::create($product->toArray());
            $relativePath = "";
            if (isset($data["image"])) {
                $relativePath = $this->saveImage($data["image"]);
            }
            $imageData = [
                'url' => $relativePath,
            ];
            $res->images()->create($imageData);
            DB::commit();
            return [
                "data" => $res,
                "status" => ApiResponseEnum::SUCCESS,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "error" => $e->getMessage(),
                "status" => ApiResponseEnum::ERROR,
            ];
        }
    }

    private function saveImage($image)
    {

        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {

            $image = substr($image, strpos($image, ',') + 1);

            $type = strtolower($type[1]);


            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'items/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }

    public function category(){
        return Category::all();
    }
}