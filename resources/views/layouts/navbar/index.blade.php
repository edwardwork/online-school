<nav class="border-b border-gray-800 pb-4">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <ul class="flex flex-col md:flex-row items-center">
            @guest
                <li class="md:ml-16 mt-3 md:mt-0 text-7xl">
                    <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                </li>
                <br>
                <li class="md:ml-16 mt-3 md:mt-0 text-7xl">
                    <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                </li>
            @else
                <li class="md:ml-16 mt-3 md:mt-0 text-7xl text-center">
                    @if(Request::is('/'))
                        <a href="{{ route('topics.list') }}" class="hover:text-gray-300">Lessons</a>
                    @else
                        <a href="{{ route('home') }}" class="hover:text-gray-300">Home</a>
                    @endif
                </li>
                <br>
                <li class="md:ml-16 mt-3 md:mt-0 text-7xl" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <a href="{{ route('logout') }}" class="hover:text-gray-300">Logout</a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
    </div>
</nav>
