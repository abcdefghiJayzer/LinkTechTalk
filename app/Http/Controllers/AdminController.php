<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Log;



class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('admin.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.add', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Add validation for the image
        ]);

        try {
            // Check if a post with the same title already exists
            $existingPost = Post::where('title', $validatedData['title'])->first();
            if ($existingPost) {
                return redirect()->route('admin.create')->with('error', 'A post with this title already exists.');
            }

            // Create a new post instance
            $post = new Post();
            $post->title = $validatedData['title'];
            $post->body = $validatedData['body'];
            $post->category_id = $validatedData['category'];

            // Handle the image upload if an image is provided
            if ($request->hasFile('image')) {
                // Store the image and get the path
                $imagePath = $request->file('image')->store('posts/images', 'public');
                $post->image = $imagePath; // Save the image path to the post
            }

            // Save the post to the database
            $post->save();

            // Redirect with a success message
            return redirect()->route('admin.create')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.create')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }



    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $posts = Post::findOrFail($id);
        $categories = Category::all();

        return view('admin.update', compact('posts', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Image validation
        ]);

        try {
            $post = Post::findOrFail($id);
            $post->title = $validatedData['title'];
            $post->body = $validatedData['body'];
            $post->category_id = $validatedData['category'];

            // Handle the image upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }

                // Store the new image and update the path
                $imagePath = $request->file('image')->store('posts/images', 'public');
                $post->image = $imagePath;
            }

            $post->save();

            return redirect()->route('admin.index')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function destroy(string $id)
    {
        $posts = Post::findOrFail($id);
        $posts->delete();

        return redirect()->route('admin.index')->with('success', 'Post Deleted successfully!');
    }

    public function showCategory()
    {
        $categories = Category::all();
        return view('admin.manage', compact('categories'));
    }

    public function addCategory()
    {
        return view('admin.category');
    }

    public function storeCategory(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        try {
            $existingCategory = Category::where('title', $validatedData['title'])->first();
            if ($existingCategory) {
                return redirect()->route('admin.addCategory')->with('error', 'A category with this title already exists.');
            }

            $post = new Category();
            $post->title = $validatedData['title'];
            $post->save();

            return redirect()->route('admin.addCategory')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());

            return redirect()->route('admin.addCategory')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function showEcategory(string $id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.ecategory', compact('categories'));
    }

    public function updateCategory(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        try {
            $post = Category::findOrFail($id);
            $post->title = $validatedData['title'];
            $post->save();

            return redirect()->route('admin.showCategory')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()->route('admin.showCategory')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroyCategory(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.showCategory')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.showCategory')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
