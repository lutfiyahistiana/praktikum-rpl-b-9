<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Colab - Sign in to your team workspace">
    <title>Colab - Sign In</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/login.js'])
</head>

<body class="font-inter bg-colab-gray h-screen overflow-hidden">
    <div class="flex h-screen w-full">

        <!-- LEFT SIDE - LOGIN FORM  -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-20 xl:px-28 py-12 relative overflow-hidden">

            <!-- Decorative Gears -->
            <div class="absolute opacity-[0.06] -top-5 -left-5 scale-150">
                <x-icons.gear-large />
            </div>
            <div class="absolute opacity-[0.04] top-[90px] left-[140px] scale-150">
                <x-icons.gear-small />
            </div>
            <div class="absolute opacity-[0.06] -bottom-5 -left-5 scale-150">
                <x-icons.gear-large />
            </div>
            <div class="absolute opacity-[0.04] bottom-[70px] left-[150px] scale-150">
                <x-icons.gear-small />
            </div>

            <!-- Logo -->
            <div class="mb-2 lg:mb-24 -ml-2 animate-slide-in-left">
                <img src="images/colab.png" alt="Colab Logo" class="w-40 sm:w-48 object-contain">
            </div>

            <!-- Form -->
            <div class="max-w-md w-full">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 animate-fade-in-up [animation-delay:0.1s]">
                    Sign in
                </h2>

                <!-- Error Message -->
                @error('email')
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm animate-fade-in-up [animation-delay:0.15s]">
                        {{ $message }}
                    </div>
                @enderror

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email -->
                    <div class="mb-5 animate-fade-in-up [animation-delay:0.2s]">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <x-icons.email-icon />
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Johndoe@student.uns.ac.id"
                                value="{{ old('email') }}"
                                class="w-full pl-11 pr-4 py-3 bg-colab-input border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 text-sm outline-none transition-[box-shadow,border-color] duration-300 ease-in-out focus:shadow-[0_0_0_3px_rgba(37,99,235,0.15)] focus:border-colab-blue"
                                required
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-5 animate-fade-in-up [animation-delay:0.3s]">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <x-icons.search-icon />
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                class="w-full pl-11 pr-12 py-3 bg-colab-input border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 text-sm outline-none transition-[box-shadow,border-color] duration-300 ease-in-out focus:shadow-[0_0_0_3px_rgba(37,99,235,0.15)] focus:border-colab-blue"
                                required
                            >
                            <button
                                type="button"
                                id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                            >
                                <x-icons.eye-icon />
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-6 animate-fade-in-up [animation-delay:0.4s]">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="appearance-none w-[18px] h-[18px] border-2 border-gray-300 rounded cursor-pointer transition-all duration-200 relative checked:bg-colab-blue checked:border-colab-blue hover:border-colab-blue mr-2.5"
                        >
                        <label for="remember" class="text-sm font-medium text-colab-blue cursor-pointer select-none">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="animate-fade-in-up [animation-delay:0.5s]">
                        <button
                            type="submit"
                            id="signInButton"
                            class="w-full py-3 bg-colab-blue text-white font-semibold rounded-lg text-sm tracking-wide relative overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-px hover:shadow-[0_6px_20px_rgba(37,99,235,0.4)] active:translate-y-0"
                        >
                            Sign in
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- RIGHT SIDE - WELCOME -->
        <div class="hidden lg:flex lg:w-1/2 p-4">
            <div class="w-full rounded-3xl bg-gradient-to-b from-blue-500 via-blue-700 to-colab-blue-super-dark flex flex-col relative overflow-hidden">

                <!-- Illustration -->
                <div class="absolute -top-32 -right-[72px] w-[130%] h-auto pointer-events-none flex items-center justify-end opacity-70">
                    <img
                        src="images/image 1.png"
                        alt="Technology Gears Illustration"
                        class="w-full h-auto object-contain select-none scale-75 translate-x-20 -translate-y-3 drop-shadow-2xl"
                        draggable="false"
                    >
                </div>

                <!-- Hero Text -->
                <div class="relative z-10 px-10 xl:px-14 flex-1 flex flex-col justify-center pt-40">
                    <h2 class="text-4xl xl:text-[44px] font-extrabold text-white mb-2 leading-tight animate-fade-in-right [animation-delay:0.3s]">
                        Welcome to the Lab
                    </h2>
                    <p class="text-white/80 text-[15px] animate-fade-in-right [animation-delay:0.5s]">
                        Colab helps your team work together in a safe and secure space.
                    </p>
                </div>

                <!-- Bottom Stepped Card -->
                <div class="relative z-[18] px-10 xl:px-14 pb-10 xl:pb-14 w-full animate-fade-in-up">
                    <div class="relative w-full drop-shadow-2xl">

                        <!-- Card Top -->
                        <div class="flex w-[80%]">
                            {{-- <div class="w-[10%] bg-transparent"></div> spacer kiri = 100% - 90% --}}
                            <div class="w-[90%] rounded-t-[24px] relative pt-8 px-8 pb-2 bg-card-blue">
                                <h3 class="text-3xl font-extrabold text-white leading-tight tracking-wide">
                                    Organize your team<br>like a pro
                                </h3>
                                <!-- Concave Curve -->
                                <div class="absolute -right-[23.5px] bottom-0 w-6 h-6"
                                    style="background: radial-gradient(circle at 100% 0%, transparent 23.5px, card-blue 24px);">
                                </div>
                            </div>
                        </div>

                        <!-- Card Bottom -->
                        <div class="rounded-b-[24px] rounded-tr-[24px] h-full pb-6 px-8 pt-6 flex-1 bg-card-blue">
                            <p class="text-white/90 text-[15px] tracking-wide">
                                Reach your goal with the right organization
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>