<x-guest-layout>
    <div class="max-w-5xl mx-auto">
      <div class="w-full rounded bg-gray-200 dark:bg-slate-800 shadow rounded-l-lg dark:border dark:border-gray-600">
          <div class="grid bg-gray-200 dark:bg-slate-800 dark:border-gray-600 grid-cols-1  mx-auto shadow-xl lg:grid-cols-2 gap-2 rounded-xl">
              <div class="hidden items-center lg:flex order-first  w-full rounded-l-lg justify-center">
                  {{-- <x-login-logo /> --}}
                  <img src="{{ asset('img/auth.jpg') }}" class="bg-white py-2 lg:py-7 rounded-l-lg" alt="">
              </div>
              <div class="flex-col justify-between items-center py-2 lg:py-7 px-3 md:px-4 lg:px-4">
                  <div class="flex flex-col items-center">
                      <x-application-logo />
                      <div class="mt-2 text-base text-gray-500 dark:text-white">
                          <p class="font-semibold font-['helvetica'] text-neutral-600 dark:text-white leading-none text-md">
                              Réquisition</p>
                      </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="space-y-3">
                        @csrf
                        <div>
                          <x-input-error :messages="session('error')" class="mb-2" />
                          <x-input-label for="username" :value="__('Username')" />
                          <x-text-input id="username" class="block w-full" type="text" name="username"
                              :value="old('username')" required />
                      </div>
                      <div>
                          <x-input-label for="password" :value="__('Mot de passe')" />
                          <x-text-input type="password" id="password" class="block w-full" name="password"
                              :value="old('password')" required />
                      </div>
                      <div class="text-center">
                          <x-primary-button class="w-full flex justify-center items-center">
                              Se connecter
                          </x-primary-button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
</x-guest-layout>
