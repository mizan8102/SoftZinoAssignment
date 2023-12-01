<?php
namespace App\DTOs\ProductDTO;

class ProductDTO
{
    public $name;
    public $description;
    public $price;
    public $category_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->price = $data['price'] ?? null;
        $this->category_id = $data['category_id'] ?? null;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}