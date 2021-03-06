<nav class="nav-gradient shadow py-6">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex items-center justify-center">
            <div class="mr-6">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                    <p class="dashboard-title uppercase">Comments API</p>
                </a>
            </div>
            <navigation
                    login="{{ route('login') }}"
                    logout="{{ route('logout') }}"
                    docs="{{ route('api_docs') }}"
                    dashboard="{{ route('dashboard') }}"
                    tokens="{{ route('tokens') }}"
                    comments="{{ route('all_comments') }}"
            >
            </navigation>
            <div class="flex-1 text-right">
                @guest
                    <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <span class="text-gray-300 text-sm pr-4">Hey {{ Auth::user()->first_name }}!</span>

                    <a href="{{ route('logout') }}"
                       class="no-underline hover:underline text-gray-300 text-sm p-3"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
