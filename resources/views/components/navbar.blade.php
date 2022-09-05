<!-- component -->
<script src="//unpkg.com/alpinejs" defer></script>
<nav class="z-0 relative" x-data="{open:false,menu:false, lokasi:false}">
    <div class="relative z-10 bg-yellow-300 shadow">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex items-center px-2 lg:px-0">
                    <a class="flex-shrink-0" href="#">
                        <img class="block lg:hidden h-12" src="{{asset('images/Logo-NF.png')}}" alt="Logo">
                        <img class="hidden lg:block h-12 w-auto" src="{{asset('images/Logo-NF.png')}}" alt="Logo">
                    </a>
                    <div class="hidden lg:block lg:ml-2">
                        <div class="flex">
                            <a href="/"
                                class=" {{Request::path()=='/' ? 'active':''}} ml-4 px-3 py-2 rounded-md text-sm leading-5  text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700 ">
                                Home </a>
                            <a href="{{route('index-document')}}"
                                class="{{Request::path()=='document' ? 'active':''}} ml-4 px-3 py-2 rounded-md text-sm leading-5  text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700  flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 mr-1  {{Request::path()=='document' ? 'text-indigo-400':''}}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                </svg>
                                Document SPM</a>
                            @auth
                            @if (Auth::user()->is_admin)
                            <a href="{{route('data-document')}}"
                                class="{{Request::path()=='data-document' ? 'active':''}} ml-4 px-3 py-2 rounded-md text-sm leading-5  text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 mr-1 {{Request::path()=='data-document' ? 'text-indigo-400':''}}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>
                                Database Document </a>
                            @endif
                            @endauth

                        </div>
                    </div>
                </div>
                <div class="flex-1 flex justify-end px-2 lg:ml-6 lg:justify-end">
                    @auth
                    <a href="#" class="flex ml-4 px-3 py-2 rounded-md text-sm leading-5  text-gray-800 outline outline-offset-2 outline-gray-500
                        font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out
                        cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Log Out</a>
                    <form action="{{route('logout')}}" id="logout-form" method="post" style="display: none">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </form>
                    @else
                    <a href="{{route('login')}}" class="md:flex items-center ml-4 px-3 py-2 rounded-md text-sm leading-5  text-blue-800
                    font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out
                    cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700"> <svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        Login</a>
                    @endauth

                </div>
                <div class="flex lg:hidden">
                    <button @click="menu=!menu"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
                        aria-label="Main menu" aria-expanded="false">
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div x-show="menu" class="block md:hidden">
            <div class="px-2 pt-2 pb-3">
                <a href="#"
                    class="mt-1 block px-3 py-2 rounded-md text-white font-semibold  hover:bg-yellow-500 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Location
                </a>
                <a href="#"
                    class="mt-1 block px-3 py-2 rounded-md text-white font-semibold  hover:bg-yellow-500 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Article
                </a>
                <a href="#"
                    class="mt-1 block px-3 py-2 rounded-md text-white font-semibold  hover:bg-yellow-500 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Recipe
                </a>
                <a href="#"
                    class="mt-1 block px-3 py-2 rounded-md text-white font-semibold  hover:bg-yellow-500 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Promo
                </a>
            </div>
        </div>
    </div>
</nav>