<nav class="bg-white shadow-sm py-3 mb-6 sticky top-0 z-40">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Logo/Brand -->
        <div class="flex items-center">
            <a href="/"
                class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition-colors flex items-center">
                <svg class="w-8 h-8 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Rent-Easy
            </a>
        </div>

        <!-- Location Selector and Search Bar -->
        <div class="hidden md:flex items-center space-x-4 flex-grow mx-8">
            <!-- Improved Location Selector -->
            {{-- <div class="relative w-64" x-data="locationDropdown()">
                <button @click="toggleDropdown()"
                    class="w-full flex justify-between items-center px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors border border-transparent focus:border-blue-500 focus:outline-none">
                    <span x-text="selectedLocation || 'Select Location'" class="truncate"></span>
                    <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': isOpen }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button> --}}

                <!-- Dropdown with loading and error states -->
                {{-- <div x-show="isOpen" @click.away="closeDropdown" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute z-50 mt-1 w-full bg-white rounded-md shadow-lg max-h-96 overflow-y-auto border border-gray-200">

                    <div x-show="isLoading" class="px-4 py-3 text-sm text-gray-500">Loading locations...</div>

                    <div x-show="error" class="px-4 py-3 text-sm text-red-500" x-text="error"></div> --}}

                    {{-- <template x-if="locations && !isLoading && !error">
                        <div class="py-1">
                            <div class="px-4 py-2 sticky top-0 bg-white border-b flex items-center">
                                <input type="text" x-model="searchQuery" @click.stop
                                    class="w-full px-2 py-1 text-sm border rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                    placeholder="Search cities...">
                            </div>
                            <template x-for="(provinceData, province) in filteredLocations">
                                <div>
                                    <div class="px-4 py-2 font-medium text-gray-700 bg-gray-50" x-text="province"></div>
                                    <template x-for="city in provinceData.cities">
                                        <button @click="selectLocation(city)"
                                            class="w-full text-left px-6 py-2 text-sm text-gray-700 hover:bg-blue-50 flex items-center">
                                            <span x-text="city" class="truncate"></span>
                                        </button>
                                    </template>
                                </div>
                            </template>
                            <div x-show="Object.keys(filteredLocations).length === 0"
                                class="px-4 py-2 text-sm text-gray-500">
                                No cities found
                            </div>
                        </div>
                    </template> --}}
                {{-- </div> --}}
            {{-- </div> --}}

            <div>
                <a href="{{ route('items.index') }}">Browse All</a>
            </div>

            <!-- Search Bar -->
            <form action="{{ route('items.index') }}" method="GET" class="flex-grow">
                <div class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="py-2 px-4 w-full rounded-l-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                        placeholder="Search for items..">
                    <button type="submit"
                        class="bg-blue-500 text-white p-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Side Icons -->
        <div class="flex items-center space-x-6">
            <!-- Cart Icon with Counter -->
<a href="/cart" class="flex items-center gap-1 p-2 text-gray-700 hover:text-blue-600 transition-colors duration-200 relative group">
    <div class="relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        @if(count(session('cart', [])) > 0)
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
            {{ count(session('cart', [])) }}
        </span>
        @endif
    </div>
    <span class="hidden md:inline-block font-medium">Cart</span>
</a>

            <!-- Improved User Auth Dropdown -->
            <div class="relative" x-data="{ open: false }">
                @auth
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none group">
                        <div
                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium group-hover:bg-blue-200 transition-colors">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100">
                        <div class="px-4 py-2 text-sm text-gray-700 border-b">
                            <div class="font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                        </div>
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Admin Dashboard</a>
                            @else
                        <a href="{{ route('user.dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">User Dashboard</a>
                            @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 border-t">
                                Sign out
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 hover:underline">Log
                            in</a>
                        <a href="{{ route('register') }}"
                            class="text-blue-600 hover:text-blue-700 hover:underline font-medium">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('locationDropdown', () => ({
            locations: null,
            isOpen: false,
            isLoading: true,
            error: null,
            selectedLocation: localStorage.getItem('selectedLocation') || '',
            searchQuery: '',

            init() {
                fetch('/nepal_locations.json')
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to load locations');
                        return response.json();
                    })
                    .then(data => {
                        this.locations = data;
                        this.isLoading = false;
                    })
                    .catch(error => {
                        this.error = error.message;
                        this.isLoading = false;
                        console.error('Error loading locations:', error);
                    });
            },

            get filteredLocations() {
                if (!this.locations) return {};
                if (!this.searchQuery) return this.locations;

                const query = this.searchQuery.toLowerCase();
                const filtered = {};

                for (const [province, data] of Object.entries(this.locations)) {
                    const cities = data.cities.filter(city =>
                        city.toLowerCase().includes(query)
                    );

                    if (cities.length > 0) {
                        filtered[province] = {
                            cities
                        };
                    }
                }

                return filtered;
            },

            toggleDropdown() {
                this.isOpen = !this.isOpen;
                if (this.isOpen && !this.locations && !this.error) {
                    this.init();
                }
            },

            closeDropdown() {
                this.isOpen = false;
                this.searchQuery = '';
            },

            selectLocation(city) {
                this.selectedLocation = city;
                localStorage.setItem('selectedLocation', city);
                this.closeDropdown();
                this.$dispatch('location-selected', {
                    city
                });
            }
        }));
    });
</script>
