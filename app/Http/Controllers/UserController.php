<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class UserController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::with('category')->get();

        return view('index', compact('posts', 'categories'));
    }

    public function view($id)
    {
        $posts = Post::with('comments.user')->findOrFail($id);

        $userHasLiked = false;
        $totalLikes = $posts->likes()->count();

        if (Auth::check()) {
            $userId = Auth::id();
            $userHasLiked = $posts->likes()->where('user_id', $userId)->exists();
        }

        return view('pages.view', compact('posts', 'userHasLiked', 'totalLikes'));
    }

    public function userSearch(Request $request)
    {
        $searchTerm = $request->input('search');
        $category = $request->input('category');

        $posts = Post::all();

        if ($searchTerm) {
            $posts = Post::where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('body', 'like', '%' . $searchTerm . '%')
                ->get();
        }

        if ($category) {
            $posts = Post::where('category_id', 'like', '%' . $category . '%')
                ->get();
        }



        if ($request->ajax()) {
            return view('pages.posts', compact('posts'));
        }

        return view('user.index', compact('posts'));
    }

    public function likePost($postId)
    {
        $post = Post::findOrFail($postId);
        $user = auth()->user();

        $like = $post->likes()->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();
        } else {
            $post->likes()->create(['user_id' => $user->id]);
        }

        return back();
    }

    public function commentOnPost(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = auth()->user();

        $post->comments()->create([
            'user_id' => $user->id,
            'comment_text' => $request->comment_text,
        ]);

        return back();
    }

    public function fbRedirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function fbCallback(Request $request, $social)
    {

        try {
            $state = $request->get('state');
            $request->session()->put('state', $state);

            $user = Socialite::driver($social)->user();
            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended(route('user.index'));
                // dd($finduser);
            } else {
                $newUser = User::create([
                    'firstname' => 'NULL',
                    'lastname' => 'NULL',
                    'username' => $user->name,
                    'email' => 'NULL',
                    'facebook_id' => $user->id,
                    'password' => encrypt('password')
                ]);

                Auth::login($newUser);
                return redirect()->intended(route('user.index'));
                // dd($newUser);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function googleRedirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function googleCallback(Request $request, $social)
    {

        try {
            $state = $request->get('state');
            $request->session()->put('state', $state);

            $user = Socialite::driver($social)->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended(route('user.index'));
                // dd($finduser);
            } else {
                $newUser = User::create([
                    'firstname' => 'NULL',
                    'lastname' => 'NULL',
                    'username' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('password')
                ]);

                Auth::login($newUser);
                return redirect()->intended(route('user.index'));

            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
