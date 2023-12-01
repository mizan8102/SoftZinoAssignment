<?php
namespace App\Repositories\Eloquent\Product;

interface ProductRepositoryInterface
{
    public function index(array $data);
    public function store(array $data): array;

    public function category();


}