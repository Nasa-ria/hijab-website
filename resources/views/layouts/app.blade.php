<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hijabis Plugg - Online Store')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --brand: #7c3aed;
            --brand-dark: #5b21b6;
            --brand-soft: #f3e8ff;
            --text-strong: #111827;
            --surface: #ffffff;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f3f4f6;
            color: var(--text-strong);
        }

        .btn-brand {
            background-color: var(--brand);
            color: white;
        }

        .btn-brand:hover {
            background-color: var(--brand-dark);
        }

        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .text-brand {
            color: var(--brand);
        }

        .section-highlight {
            background: linear-gradient(90deg, rgba(124,58,237,0.08), rgba(79,70,229,0.04));
        }

        .mobile-menu {
            display: none;
        }

        @media (max-width: 767px) {
            .mobile-menu {
                display: block;
            }
        }
    </style>
</head>
<body class="antialiased">
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-200 shadow-sm">
        <div class="page-container flex items-center justify-between gap-4 py-4">
            <a href="/" class="flex items-center gap-3 font-semibold text-2xl text-brand">
                <i class="fas fa-shopping-bag"></i>
                Hijabis Plugg
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-700">
                <a href="/" class="hover:text-brand transition {{ request()->is('/') ? 'text-brand' : '' }}">Home</a>
                <a href="{{ route('products.index') }}" class="hover:text-brand transition {{ request()->routeIs('products.*') ? 'text-brand' : '' }}">Shop</a>
                <a href="{{ route('products.index') }}#categories" class="hover:text-brand transition">Categories</a>
                <a href="{{ route('cart.index') }}" class="hover:text-brand transition">Cart</a>
                <a href="{{ route('contact') }}" class="hover:text-brand transition {{ request()->routeIs('contact') ? 'text-brand' : '' }}">Contact</a>
            </nav>

            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('cart.index') }}" class="relative text-slate-700 hover:text-brand transition">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                </a>
                @auth
                    <div class="relative dropdown">
                        <button class="flex items-center gap-2 text-slate-700 hover:text-brand transition">
                            <i class="fas fa-user-circle text-lg"></i>
                            <span>{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="dropdown-menu hidden absolute right-0 mt-3 w-48 rounded-xl border border-slate-200 bg-white shadow-xl py-2">
                            @if(!auth()->user()->isAdmin())
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">My Orders</a>
                            @endif
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Admin Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-slate-700 hover:text-brand transition">Login</a>
                    <a href="{{ route('register') }}" class="rounded-full border border-brand bg-brand text-white px-4 py-2 text-sm hover:bg-brand-dark transition">Register</a>
                @endauth
            </div>

            <button id="mobile-menu-button" class="mobile-menu rounded-full border border-slate-200 bg-white p-3 text-slate-700 shadow-sm">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div id="mobile-menu" class="hidden border-t border-slate-200 bg-white md:hidden">
            <div class="space-y-2 px-4 py-4 text-slate-700">
                <a href="/" class="block rounded-xl px-4 py-3 hover:bg-slate-100 transition">Home</a>
                <a href="{{ route('products.index') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-100 transition">Shop</a>
                <a href="{{ route('products.index') }}#categories" class="block rounded-xl px-4 py-3 hover:bg-slate-100 transition">Categories</a>
                <a href="{{ route('cart.index') }}" class="flex items-center justify-between rounded-xl px-4 py-3 hover:bg-slate-100 transition">
                    <span>Cart</span>
                    @if($cartCount > 0)
                        <span class="rounded-full bg-red-500 px-2 py-1 text-[10px] font-semibold text-white">{{ $cartCount }}</span>
                    @endif
                </a>
                <a href="{{ route('contact') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-100 transition">Contact</a>
                @auth
                    <a href="{{ route('orders.index') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-100 transition">My Orders</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-100 transition">Admin Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-left text-slate-700 hover:bg-slate-100 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-100 transition">Login</a>
                    <a href="{{ route('register') }}" class="block rounded-xl border border-brand bg-brand text-white px-4 py-3 text-center hover:bg-brand-dark transition">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Alerts -->
    @if($errors->any())
        <div class="fixed top-24 right-4 z-50 rounded-2xl border border-red-200 bg-red-50 p-4 shadow-lg text-red-700 max-w-sm">
            <p class="font-semibold">There was a problem:</p>
            <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="fixed top-24 right-4 z-50 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 shadow-lg text-emerald-700 max-w-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-24 right-4 z-50 rounded-2xl border border-red-200 bg-red-50 p-4 shadow-lg text-red-700 max-w-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-200">
        <div class="page-container py-12">
            <div class="grid gap-8 md:grid-cols-4">
                <div>
                    <h3 class="text-xl font-bold text-white">Hijabis Plugg</h3>
                    <p class="mt-3 text-sm text-slate-400">A modern marketplace built for thoughtful shopping, quality products, and secure checkout experiences.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Shop</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition">All Products</a></li>
                        <li><a href="{{ route('products.index') }}?sort=price_low" class="hover:text-white transition">Best Deals</a></li>
                        <li><a href="{{ route('products.index') }}?sort=rating" class="hover:text-white transition">Top Rated</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Shipping</a></li>
                        <li><a href="#" class="hover:text-white transition">Returns</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Stay Connected</h4>
                    <p class="text-sm text-slate-400">Follow us for new arrivals, offers, and customer stories.</p>
                    <div class="mt-4 flex items-center gap-3 text-slate-200">
                        <a href="#" class="hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-10 border-t border-slate-800 pt-6 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} Hijabis Plugg. Built for a seamless shopping experience.
            </div>
        </div>
    </footer>

    <script>
        const mobileButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileButton && mobileMenu) {
            mobileButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.dropdown');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            if (!dropdown || !dropdownMenu) {
                return;
            }

            if (dropdown.contains(event.target) && event.target.closest('button')) {
                dropdownMenu.classList.toggle('hidden');
            } else if (!dropdown.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        setTimeout(() => {
            document.querySelectorAll('.fixed').forEach(alert => alert.remove());
        }, 5000);
    </script>
</body>
</html>
