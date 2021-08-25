<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCategory extends Component
{
    use WithPagination;

    public $category_id;
    public $products_data;
    public $category;
    public $slug;

    protected $paginationTheme = 'pagination-links';

    public function render()
    {
        $category = Category::where('slug', $this->slug)->where('status', 1)->first();

        if(!$category){
          abort('404');
        }

        $this->category = $category;
        $product_data = Product::where('category_id', $category->id)->where('status', 1)->paginate(12);
    
        return view('livewire.product-category',['products'=>$product_data]);
    }

    public function mount($slug)
    {
      $this->slug= $slug;
    }
}
