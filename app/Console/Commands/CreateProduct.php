<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product with a selected category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter the product name');
        $description = $this->ask('Enter the product description (optional)');
        $price = $this->ask('Enter the product price');

        // Display available categories for selection
        $categories = Category::pluck('name', 'id')->toArray();
        $category_name = $this->choice('Select a category:', $categories);
        $categoryNameToSearch = $category_name;
        $categoryId = array_search($categoryNameToSearch, $categories);
        // Create the product
        $product = Product::create([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId,
        ]);

        $this->info('Product created successfully:');
        $this->table(['ID', 'Name', 'Description', 'Price', 'Category ID'], [
            [$product->id, $product->name, $product->description, $product->price, $product->category_id],
        ]);
    }

}
