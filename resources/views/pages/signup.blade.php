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
                Sign Up for an Account
            </h1>
            <form class="space-y-4" action="{{ route('user.register') }}" method="POST">
                @csrf
                <div>
                    <input type="text" name="firstname" placeholder="First Name"
                        class="mt-1 block w-full p-2.5 rounded-lg bg-neutral-700 text-white" required>
                </div>
                <div>
                    <input type="text" name="lastname" placeholder="Last Name"
                        class="mt-1 block w-full p-2.5 rounded-lg bg-neutral-700 text-white" required>
                </div>
                <div>
                    <input type="text" name="username" placeholder="Username"
                        class="mt-1 block w-full p-2.5 rounded-lg bg-neutral-700 text-white" required>
                </div>
                <div>
                    <input type="email" name="email" placeholder="Email"
                        class="mt-1 block w-full p-2.5 rounded-lg bg-neutral-700 text-white" required>
                </div>
                <div>
                    <input type="password" name="password" placeholder="Create Password"
                        class="mt-1 block w-full p-2.5 rounded-lg bg-neutral-700 text-white" required>
                </div>
                <div>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                        class="mt-1 block w-full p-2.5 rounded-lg bg-neutral-700 text-white" required>
                </div>
                <button type="submit"
                    class="w-full bg-orange-600 text-white font-medium rounded-lg px-5 py-2.5 text-center hover:bg-orange-700">
                    Sign Up
                </button>
                <p class="text-sm text-neutral-400 text-center">
                    Already have an account?
                    <a href="{{ route('user.login') }}" class="text-orange-500 hover:underline">Sign In</a>
                </p>
            </form>

        </div>
    </div>
</section>
