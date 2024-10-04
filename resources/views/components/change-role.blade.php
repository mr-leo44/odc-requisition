@props(['user'])
@php
    $roles = App\Enums\RoleEnum::cases();
@endphp
<div id="change-role" tabindex="-1" aria-hidden="true"
    class="hidden mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center max-w-7xl md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-lg bg-gray-900 dark:bg-gray-800 dark:border-gray-600">
                <div id="title"></div>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="change-role">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="max-h-auto mx-auto max-w-5xl">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white px-3 py-2 rounded-lg mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="list-none">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="w-full" action="{{ route('users.changeRole', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="id">
                        </div>
                        <div class="mt-4 max-w-lg mx-full">
                            <x-input-label for="role" :value="__('Rôle')" />
                            <select name="role" id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->value }}"
                                        @if ($user->compte->role === $role->value) selected="true" @endif>{{ $role->value }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>
                        <div class="flex justify-end mt-3 mb-4">
                            <button type="submit"
                                class="text-white bg-gray-900 hover:bg-theme focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                Soumettre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeRole(event, user) {
        event.preventDefault()
        const title = document.getElementById('title')
        title.innerHTML =
            `<h3 class="text-xl font-semibold text-white rouned-md dark:text-white px-6" id="title">Changement du rôle de ${user.name}</h3><h3 class="text-xl font-semibold text-white rouned-md dark:text-white px-6" id="title">Rôle actuel : ${user.compte.role}</h3> `
        const id = document.getElementById('id')
        id.innerHTML = `<input type="hidden" name="id" value="${user.id}">`
    }
</script>
