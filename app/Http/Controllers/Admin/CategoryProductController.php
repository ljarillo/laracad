<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $product, $category;
    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;

        $this->middleware(['can:products']);
    }

    /**
     * product to categories
     *
     * @param  int  $idProduct
     * @return \Illuminate\Http\Response
     */
    public function categories($idProduct)
    {
        if(!$product = $this->product->find($idProduct)){
            return redirect()->back();
        }


        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * product to categories
     *
     * @param  int  $idCategory
     * @return \Illuminate\Http\Response
     */
    public function products($idCategory)
    {
        if(!$category = $this->category->find($idCategory)){
            return redirect()->back();
        }

        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', [
            'category' => $category,
            'products' => $products
        ]);
    }

    /**
     * categories available to product
     *
     * @param  int  $idProduct
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function categoriesAvailable(Request $request, $idProduct)
    {
        if(!$product= $this->product->find($idProduct)){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $categories = $product->categoryAvailable($request->filter);

        return view('admin.pages.products.categories.available', [
            'product' => $product,
            'categories' => $categories,
            'filters' => $filters
        ]);
    }

    /**
     * attach categories to product
     *
     * @param  int  $idProduct
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachCategoriesProduct(Request $request, $idProduct)
    {
        if(!$product = $this->product->find($idProduct)){
            return redirect()->back();
        }

        if(!$request->categories || count($request->categories) == 0){
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos uma categoria');
        }

        $product->categories()->attach($request->categories);

        return redirect()
            ->route('products.categories', $product->id)
            ->with('message', 'Atribuida as categorias');
    }

    /**
     * detach categories to product
     *
     * @param  int  $idProduct
     * @param  int  $idCategory
     * @return \Illuminate\Http\Response
     */
    public function detachCategoriesProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);
        if(!$product || !$category){
            return redirect()->back();
        }

        $product->categories()->detach($category);

        return redirect()
            ->route('products.categories', $product->id)
            ->with('message', "Desvinculada a categoria {$category->name} do produto");
    }
}
