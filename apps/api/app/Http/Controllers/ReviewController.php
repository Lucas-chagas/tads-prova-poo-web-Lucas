<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::paginate();
    }

    public function store(ReviewStoreRequest $request)
    {
        $review = new Review();
        $review->product_id = $request->product_id;
        $review->customer_id = $request->customer_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment                            ;
        $category->description = $request->description;

        $category->save();

        return $category;
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(
        Category $category,
        Request $request
    ) {
        $category->name = $request->name ?? $category->name;
        $category->description = $request->description ?? $category->description;

        $category->save();

        return $category;
    }

    public function destroy(
        Category $category
    ) {
        $hasProduct = \App\Models\Product::where('category_id', $category->id)->exists();

        if ($hasProduct) {
            // 422 Unprocessable Entity
            return response()->json([
                'message' => 'Categoria com produtos relacionados',
            ], 404);
        }

        $category->delete();

        // 204 No Content
        return response()->json([
            'message' => 'Categoria excluída',
        ], 204);
    }
}
