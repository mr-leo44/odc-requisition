<x-guest-layout>
  @if (session('error'))
      <div id="error-message"
          class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
          role="alert">
          <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 20 20">
              <path
                  d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
          </svg>
          <span class="sr-only">Info</span>
          <div class="ms-3 text-sm font-medium">
              {{ session('error') }}
          </div>
          <button type="button"
              class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
              data-dismiss-target="#error-message" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
          </button>
      </div>
  @endif
      <!-- component -->
      <section>
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 md:px-12 lg:px-24 lg:py-24">
          {{-- <div class="justify-center mx-auto text-left align-bottom transition-all transform bg-white rounded-lg sm:align-middle sm:max-w-2xl sm:w-full"> --}}
            <div class="grid bg-slate-100 flex-wrap items-center justify-center grid-cols-1 mx-auto shadow-xl lg:grid-cols-2 gap-2 rounded-xl">
              <div class="w-full px-6 py-3">
                <div>
                  <div  class="flex flex-col items-center pb-10">
                    <x-application-logo/>
                    <div class="mt-4 text-base text-gray-500">
                      <p class="font-bold text-neutral-600 l eading-6 lg:text-2xl">-Réquisition-</p>
                    </div>
                  </div>
                  <div class="mt-1 text-left sm:mt-5">
                    <div class="inline-flex items-center w-full">
                      <h3 class="text-lg font-bold text-neutral-600 l eading-6 lg:text-5xl">Sign up</h3>
                    </div>
                  </div>
                </div>       
                <div class="mt-1 space-y-2">
                  <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-neutral-600">Username</label>
                        <div class="mt-1">
                            <input id="username" name="username" type="username" placeholder="Your username" class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" required autofocus autocomplete="username">
                        </div>
                        @error('username')
                        <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="password" class="block text-sm font-medium text-neutral-600"> Password </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password" required="" placeholder="Your Password" class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                        </div>
                        @error('password')
                        <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" placeholder="Your password" class="w-4 h-4 text-blue-600 border-gray-200 rounded focus:ring-blue-500">
                            <label for="remember_me" class="block ml-2 text-sm text-neutral-600"> Remember me </label>
                        </div>
                        <div class="text-sm">
                          @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500"> Forgot your password? </a>
                          @endif
                          
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="flex items-center justify-center w-full px-10 py-4 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Sign in</button>
                    </div>
                </form>
                </div>
              </div>
              <div class="order-first hidden w-full lg:block"><!-- section logo du log in-->
                <x-login-logo />
              </div>
            </div>
          </div>
        </div>
      </section>
  
</x-guest-layout>
