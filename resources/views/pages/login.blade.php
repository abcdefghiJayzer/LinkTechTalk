@include('includes.header')

<head>
    <title>LinkTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<section class="bg-neutral-900 min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-neutral-800 rounded-lg shadow border border-neutral-700">
        <div class="p-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl text-center p-4">
                Sign in to your account
            </h1>
            <form class="space-y-4" action="{{ route('user.authenticate') }}" method="POST">
                @csrf
                <div>

                    <input type="text" name="username_email" id="username_email"
                        class="mt-1 block w-full p-2.5 rounded-lg bg-neutral-700 text-white"
                        placeholder="Enter your email" required>
                </div>
                <div>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full p-2.5 rounded-lg border border-neutral-600 bg-neutral-700 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter your password" required>
                </div>
                <button type="submit"
                    class="w-full bg-orange-600 text-white font-medium rounded-lg px-5 py-2.5 text-center hover:bg-orange-700">
                    Sign In
                </button>
                <p class="text-sm text-neutral-400 text-center">
                    Don't have an account yet?
                    <a href="{{ route('user.signup') }}" class="text-orange-500 hover:underline">Sign up</a>
                </p>
            </form>

            <p class="text-center text-white pt-6">or Sign in with</p>
            <div class="flex justify-between gap-4 pt-6 h-16">

                <a href="{{ route('google-redirect', 'google') }}"
                    class="flex items-center justify-center bg-neutral-200 text-black py-2 px-4 rounded-lg shadow-md hover:bg-orange-200 w-full text-center">
                    <span class="mr-2">Google</span>
                    <i class="fab fa-google"></i>
                </a>
                <a href="{{ route('facebook-redirect', 'facebook') }}"
                    class="flex items-center justify-center bg-blue-800 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 w-full text-center">
                    <span class="mr-2">Facebook</span>
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>

        </div>
    </div>
</section>
