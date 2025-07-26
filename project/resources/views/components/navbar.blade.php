<nav class="bg-[#131417] text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <!-- Logo -->
                    <a href="/" class="flex items-center gap-2">
                        <img src="{{ asset('images/logoo.png') }}" alt="LicomSIA Logo" class="h-10 w-10">
                        <span class="text-xl font-bold text-[#2768bc]">Licom</span>
                        <span class="text-xl font-bold text-white">SIA</span>
                    </a>
                </div>
            </div>
            
            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-[#e2e4e3] hover:text-white hover:bg-[#343434]">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" id="menu-icon"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" id="close-icon" class="hidden"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Desktop menu -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                <a href="#home" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#343434]">Home</a>
                <a href="#about" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#343434]">About</a>
                <a href="#features" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#343434]">Features</a>
                <a href="#programs" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#343434]">Programs</a>
                <a href="#testimonials" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#343434]">Testimonials</a>
                <a href="#contact" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#343434]">Contact</a>
                <a href="student/login" class="ml-4 px-4 py-2 rounded-md text-sm font-medium bg-[#2768bc] hover:bg-[#578eb7] text-white">Login</a>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#home" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#343434]">Home</a>
            <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#343434]">About</a>
            <a href="#features" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#343434]">Features</a>
            <a href="#programs" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#343434]">Programs</a>
            <a href="#testimonials" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#343434]">Testimonials</a>
            <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#343434]">Contact</a>
            <a href="/login" class="block px-3 py-2 rounded-md text-base font-medium bg-[#2768bc] hover:bg-[#578eb7] text-white mt-4">Login</a>
        </div>
    </div>
    
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });
    </script>
</nav> 