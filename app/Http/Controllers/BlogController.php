<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\Blogs;
use App\Models\Domain;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs =  Blogs::all();
        return view('adminPanel.blogs.index', compact('blogs'));
    }

    public function showCategory()
    {
        $category = BlogCategory::all();
        return view('adminPanel.blogs.category', compact('category'));
    }

    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function deleteCategory($id)
    {
        $category = BlogCategory::find($id);
        if ($category) {
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        }
        return redirect()->back()->with('error', 'Category not found.');
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $domains = Domain::all();
        return view('adminPanel.blogs.create', compact('categories','domains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'nullable|string|max:255',
            'is_view' => 'nullable|integer|min:0',
        ]);

        $blog = new Blogs();
        $blog->title = $request->input('title');
        $slug = Str::slug($request->input('title'), '-') . '-' . time();
        $blog->slug = $slug;
        $blog->content = $request->input('content');
        $blog->category_id = $request->input('category_id');
        $blog->domain_id = $request->input('domain_id', 1); // Default domain_id to 1 if not provided

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.webp';

            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $image = $manager->read($image)->toWebp(90);

            $directory = storage_path('app/public/blog_images');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $path = $directory . '/' . $image_name;
            $image->save($path);

            $blog->image = 'blog_images/' . $image_name;
        }


        $blog->author = $request->author;
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = Blogs::find($id);
        $categories = BlogCategory::all();
        $domains = Domain::all();
        if (!$blog) {
            return redirect()->back()->with('error', 'Blog not found.');
        }
        return view('adminPanel.blogs.edit', compact('blog', 'categories','domains'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'nullable|string|max:255',
            'domain_id' => 'nullable|integer|min:0',
        ]);

        $blog = Blogs::find($id);
        if (!$blog) {
            return redirect()->back()->with('error', 'Blog not found.');
        }

        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->category_id = $request->input('category_id');
        $blog->author = $request->input('author');
        $blog->domain_id = $request->input('domain_id', $blog->domain_id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.webp';

            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $image = $manager->read($image)->toWebp(90);

            $directory = storage_path('app/public/blog_images');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $path = $directory . '/' . $image_name;
            $image->save($path);

            $blog->image = 'blog_images/' . $image_name;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blogs::find($id);
        if ($blog) {
            $blog->delete();
            return redirect()->back()->with('success', 'Blog deleted successfully.');
        }
        return redirect()->back()->with('error', 'Blog not found.');
    }

    public function show($id)
    {
        $blog = Blogs::find($id);
        if (!$blog) {
            return redirect()->back()->with('error', 'Blog not found.');
        }
        $blog->increment('is_view');
        return view('adminPanel.blogs.show', compact('blog'));
    }
}
