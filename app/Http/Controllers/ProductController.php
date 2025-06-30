<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        dd('test');
    }

    public function getProduct()
    {
        $user_id = auth()->user()->id;

        $categories = Category::where('user_id', $user_id)
            ->with('product')
            ->get();

        return view('products.index', compact('categories'));
    }

    public function getProductImage($path)
    {
        if (!auth()->check()) {
            abort(403);
        }

        return response()->file(storage_path('app/' . $path));
    }

    public function batchStore(Request $request)
    {
        if (!auth()->check()) {
            abort(403);
        }

        $results = [];

        if ($request->has('deleted_products')) {
            Product::whereIn('id', $request->deleted_products)->delete();
        }

        if ($request->has('deleted_categories')) {
            $categoryIds = $request->deleted_categories;
            Product::whereIn('category_id', $categoryIds)->delete();
            Category::whereIn('id', $categoryIds)->delete();
        }

        foreach ($request->products as $index => $product) {
            try {
                if (!empty($product['description']) && isset($product['image']) && $product['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $product['image']->store('private/products');

                    $new = Product::create([
                        'user_id'     => auth()->id(),
                        'category_id' => $product['category_id'],
                        'description' => $product['description'],
                        'image'       => $path,
                    ]);

                    $results[] = ['index' => $index, 'status' => 'created', 'id' => $new->id];
                }
            } catch (\Exception $e) {
                $results[] = ['index' => $index, 'status' => 'failed'];
            }
        }

        return response()->json(['results' => $results]);
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'description' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'private');
            $product->image = $imagePath;
        }

        $product->description = $request->description;
        $product->save();

        return response()->json(['message' => 'Updated']);
    }
}
