<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;

    protected $fillable = ['title', 'flag', 'price', 'description', 'image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function search($filter = null)
    {
        $results = $this->where('title', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->latest()
            ->paginate();

        return $results;
    }

    public function categoryAvailable($filter = null)
    {
        $categories = Category::whereNotIn('categories.id', function ($query){
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter){
                if($filter)
                    $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();

        return $categories;
    }
}
