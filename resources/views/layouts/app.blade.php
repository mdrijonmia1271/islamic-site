<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- STEP 14 — Title, Description & Canonical -->
        <title>@yield('title', config('app.name', 'Islamic Site'))</title>
        <meta name="description" content="@yield('meta_description', 'Islamic knowledge, Quran, Hadith, Dua, Prayer Times and Islamic Calendar.')">
        <meta name="robots" content="@yield('meta_robots', 'index,follow')">
        @hasSection('meta_keywords')
            <meta name="keywords" content="@yield('meta_keywords')">
        @endif

        @hasSection('canonical')
            <link rel="canonical" href="@yield('canonical')">
        @else
            <link rel="canonical" href="{{ url()->current() }}">
        @endif

        <!-- STEP 15 — Open Graph SEO -->
        <meta property="og:title" content="@yield('title', config('app.name', 'Islamic Site'))">
        <meta property="og:description" content="@yield('meta_description', 'Islamic knowledge, Quran, Hadith, Dua, Prayer Times and Islamic Calendar.')">
        <meta property="og:type" content="@yield('og_type', 'website')">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ config('app.name', 'Islamic Site') }}">
        @hasSection('og_image')
            <meta property="og:image" content="@yield('og_image')">
        @endif

        <!-- STEP 16 — Twitter/X Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', config('app.name', 'Islamic Site'))">
        <meta name="twitter:description" content="@yield('meta_description', 'Islamic knowledge, Quran, Hadith, Dua, Prayer Times and Islamic Calendar.')">
        @hasSection('og_image')
            <meta name="twitter:image" content="@yield('og_image')">
        @endif

        <!-- Extra Page-Specific Meta / Schema -->
        @yield('meta')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-gray-950 text-gray-800 dark:text-gray-100 min-h-screen flex flex-col">
        <!-- Navigation Menu -->
        @include('layouts.navigation')

        <!-- Page Heading (Optional) -->
        @isset($header)
            <header class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')

        <!-- Global AJAX Favorite & Bookmark Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.addEventListener('submit', function (event) {
                    const form = event.target.closest('form[action*="favorites"], form[action*="bookmark"]');
                    if (!form) return;

                    event.preventDefault();
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) submitBtn.disabled = true;

                    const formData = new FormData(form);
                    const action = form.getAttribute('action');
                    const isBookmarkAction = action.includes('bookmark');
                    const method = (form.querySelector('input[name="_method"]')?.value || form.getAttribute('method') || 'POST').toUpperCase();

                    const headers = {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    };

                    let fetchOptions = {
                        method: method === 'DELETE' ? 'DELETE' : 'POST',
                        headers: headers,
                    };

                    if (method === 'DELETE') {
                        fetchOptions.headers['Content-Type'] = 'application/json';
                        const payload = {};
                        formData.forEach((value, key) => { payload[key] = value; });
                        fetchOptions.body = JSON.stringify(payload);
                    } else {
                        fetchOptions.body = formData;
                    }

                    fetch(action, fetchOptions)
                        .then(res => {
                            if (res.status === 401) {
                                window.location.href = "{{ route('login') }}";
                                return null;
                            }
                            return res.json();
                        })
                        .then(data => {
                            if (!data) return;

                            if (isBookmarkAction) {
                                showToast(data.is_bookmarked ? '🔖 ' + (data.message || 'বুকমার্কে সংরক্ষণ করা হয়েছে!') : '🏷️ ' + (data.message || 'বুকমার্ক সরানো হয়েছে।'));
                            } else {
                                showToast(data.is_favorite ? '❤️ ' + (data.message || 'পছন্দের তালিকায় যুক্ত হয়েছে!') : '🤍 ' + (data.message || 'পছন্দের তালিকা থেকে সরানো হয়েছে।'));
                            }

                            // If deleting on index pages, smoothly remove the card
                            const card = form.closest('.group') || form.closest('.favorite-card');
                            if ((window.location.pathname.includes('favorites') || window.location.pathname.includes('bookmarks')) && method === 'DELETE' && card) {
                                card.style.transition = 'all 0.3s ease';
                                card.style.opacity = '0';
                                card.style.transform = 'scale(0.95)';
                                setTimeout(() => card.remove(), 300);
                                return;
                            }

                            // Toggle button in-place
                            if (isBookmarkAction) {
                                if (data.is_bookmarked) {
                                    form.innerHTML = `
                                        <input type="hidden" name="_token" value="${headers['X-CSRF-TOKEN']}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="type" value="${formData.get('type')}">
                                        <input type="hidden" name="id" value="${formData.get('id')}">
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-800 hover:bg-amber-100 text-xs font-bold transition shadow-sm" title="বুকমার্ক থেকে সরান">
                                            <span>🔖</span> <span>বুকমার্ক করা</span>
                                        </button>
                                    `;
                                } else {
                                    form.innerHTML = `
                                        <input type="hidden" name="_token" value="${headers['X-CSRF-TOKEN']}">
                                        <input type="hidden" name="type" value="${formData.get('type')}">
                                        <input type="hidden" name="id" value="${formData.get('id')}">
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 hover:text-amber-600 transition text-xs font-semibold shadow-sm" title="পরে পড়ার জন্য বুকমার্ক করুন">
                                            <span>🏷️</span> <span>বুকমার্ক</span>
                                        </button>
                                    `;
                                }
                            } else {
                                if (data.is_favorite) {
                                    form.innerHTML = `
                                        <input type="hidden" name="_token" value="${headers['X-CSRF-TOKEN']}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="type" value="${formData.get('type')}">
                                        <input type="hidden" name="id" value="${formData.get('id')}">
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-red-50 dark:bg-red-950/60 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 text-xs font-bold transition shadow-sm">
                                            <span>❤️</span> <span>সংরক্ষিত (Saved)</span>
                                        </button>
                                    `;
                                } else {
                                    form.innerHTML = `
                                        <input type="hidden" name="_token" value="${headers['X-CSRF-TOKEN']}">
                                        <input type="hidden" name="type" value="${formData.get('type')}">
                                        <input type="hidden" name="id" value="${formData.get('id')}">
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 hover:text-red-600 transition text-xs font-semibold shadow-sm">
                                            <span>🤍</span> <span>পছন্দের তালিকায় রাখুন</span>
                                        </button>
                                    `;
                                }
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            if (submitBtn) submitBtn.disabled = false;
                        });
                });

                function showToast(message) {
                    let toast = document.getElementById('global-toast');
                    if (!toast) {
                        toast = document.createElement('div');
                        toast.id = 'global-toast';
                        toast.className = 'fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl bg-gray-900/95 dark:bg-emerald-950/95 text-white text-xs font-bold shadow-2xl border border-gray-700 dark:border-emerald-800 flex items-center gap-2 transform transition-all duration-300 translate-y-10 opacity-0 backdrop-blur-md';
                        document.body.appendChild(toast);
                    }
                    toast.innerHTML = message;
                    toast.classList.remove('translate-y-10', 'opacity-0');
                    setTimeout(() => {
                        toast.classList.add('translate-y-10', 'opacity-0');
                    }, 3000);
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>
