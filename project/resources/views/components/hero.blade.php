<section id="home" class="bg-gradient-to-r from-[#131417] to-[#343434] py-20 lg:py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <div class="lg:w-1/2">
                <div class="mb-4">
                    <span class="inline-block py-1 px-3 bg-primary/20 text-primary font-medium text-sm rounded-full">
                        Admissions Now Open for 2023-2024
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                    <span class="text-[#578eb7]">LicomSIA</span>: Student Information System
                </h1>
                <p class="mt-6 text-lg md:text-xl text-[#e2e4e3] max-w-2xl leading-relaxed">
                    A comprehensive cross-platform student information system designed specifically for Libon Community College. Streamline admissions, manage student records, and enhance administrative efficiency.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="/admission" class="px-8 py-3 bg-[#578eb7] hover:bg-[#2768bc] text-white font-medium rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
                        Apply Now
                    </a>
                 
                </div>
            </div>
            <div class="lg:w-1/2 mt-10 lg:mt-0 relative">
                <!-- Main central image -->
                <div class="bg-white rounded-lg shadow-xl overflow-hidden max-w-md mx-auto z-10 relative">
                    <div class="bg-gray-100 py-3 px-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-[#578eb7] flex items-center justify-center text-white font-bold">L</div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-800">LicomSIA</p>
                                <p class="text-xs text-gray-500">Libon Community College</p>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('images/background.png') }}" alt="LicomSIA Dashboard" class="w-full">
                    <div class="p-3 border-t border-gray-200">
                        <div class="flex items-center space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#578eb7]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span class="text-gray-700 font-medium">1.2K likes</span>
                        </div>
                    </div>
                </div>
                
                <!-- Left floating image with heart -->
                <div class="absolute top-1/4 -left-16 hidden md:block" style="z-index: 5; transform: rotate(-5deg);">
                    <div class="relative">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-32 h-32">
                            <img src="{{ asset('images/background1.png') }}" alt="LicomSIA Feature" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -top-3 -right-3 bg-red-500 text-white p-2 rounded-full shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="white" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Right floating image with heart -->
                <div class="absolute bottom-1/4 -right-16 hidden md:block" style="z-index: 5; transform: rotate(5deg);">
                    <div class="relative">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-32 h-32">
                            <img src="{{ asset('images/background1.png') }}" alt="LicomSIA Feature" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -top-3 -right-3 bg-red-500 text-white p-2 rounded-full shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="white" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Floating badge -->
                <div class="absolute -bottom-6 -left-6 md:left-12 bg-amber-500 text-white py-2 px-4 rounded-lg shadow-lg transform rotate-3 z-20">
                    <span class="font-bold text-sm">Apply Now!</span>
                </div>
            </div>
        </div>
    </div>
</section> 