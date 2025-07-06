<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#131417] to-[#343434] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="bg-[#2768bc] py-6">
            <div class="flex justify-center">
                <!-- add logo here -->
                <h2 class="text-center text-3xl font-bold text-white">LicomSIA</h2>
            </div>
        </div>
        
        <div class="px-8 py-6">
            <h2 class="text-center text-xl font-semibold text-gray-700 mb-6">Sign in to your account</h2>
            
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="mt-1">
                        <input id="username" name="username" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#2768bc] focus:border-[#2768bc]">
                    </div>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#2768bc] focus:border-[#2768bc]">
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-[#2768bc] focus:ring-[#2768bc] border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    
                    <div class="text-sm">
                        <a href="#" class="font-medium text-[#2768bc] hover:text-[#578eb7]">Forgot your password?</a>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2768bc] hover:bg-[#578eb7] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2768bc]">
                        Sign in
                    </button>
                </div>
            </form>
            
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Sign in as</span>
                    </div>
                </div>
                
                <div class="mt-6 grid grid-cols-3 gap-3">
                    <div>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Student
                        </a>
                    </div>
                    <div>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Instructor
                        </a>
                    </div>
                    <div>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-8 py-4 bg-[#e2e4e3] border-t border-gray-200">
            <p class="text-xs text-center text-gray-600">
                &copy; {{ date('Y') }} Libon Community College. All rights reserved.
            </p>
        </div>
    </div>
</div> 