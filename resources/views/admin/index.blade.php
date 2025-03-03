
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="font-semibold text-3xl text-gray-800 mb-3 md:mb-0 dark:text-white leading-tight">
                {{ __('Administration') }}
            </h2>
            <div>
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                    data-tabs-toggle="#default-styled-tab-content"
                    data-tabs-active-classes="text-white bg-gray-900 px-6 py-3 dark:bg-[#ff7900] rounded-lg"
                    data-tabs-inactive-classes="text-gray-500 hover:text-gray-600 dark:text-gray-400 hover:border-gray-300 dark:hover:text-gray-300"
                    role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block ease-in transition-all duration-75 p-4 rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="user-styled-tab" data-tabs-target="#styled-user" type="button" role="tab"
                            aria-controls="user" aria-selected="false">Utilisateurs</button>
                    </li>

                    <li class="me-2" role="presentation">
                        <button class="inline-block ease-in transition-all duration-75 p-4 rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="direction-styled-tab" data-tabs-target="#styled-direction" type="button" role="tab"
                            aria-controls="direction" aria-selected="false">Directions</button>
                    </li>

                    <li class="me-2" role="presentation">
                        <button class="inline-block ease-in transition-all duration-75 p-4 rounded-lg"
                            id="approver-styled-tab" data-tabs-target="#styled-approver" type="button"
                            role="tab" aria-controls="approver" aria-selected="false">Approbateurs</button>
                    </li>

                    <li class="me-2" role="presentation">
                        <button class="inline-block ease-in transition-all duration-75 p-4 rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="delegation-styled-tab" data-tabs-target="#styled-delegation" type="button" role="tab"
                            aria-controls="delegation" aria-selected="false">Délegation</button>
                    </li>

                </ul>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8">
        <div>
            <div class="w-full p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="text-gray-900 dark:text-white">
                    <div id="default-styled-tab-content">
                        <x-approvers :approbateurs="$approbateurs" id="styled-approver" class="hidden" />
                        <x-users :users="$users" :usersList="$usersList" :directions="$directions" :services="$services" :cities="$cities" id="styled-user" class="hidden" />
                        <x-delegations :usersList="$usersList" :delegations="$delegations" :users="$users" :directions="$directions" :services="$services"  />
                        <x-directions :directions="$directions"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const approverButton = document.getElementById("approver-styled-tab");
        const approverTab = document.getElementById("styled-approver");
        const delegationTab = document.getElementById('styled-delegation');
        const delegationButton = document.getElementById("delegation-styled-tab");
        const userButton = document.getElementById("user-styled-tab");
        const userTab = document.getElementById("styled-user");

        const directionButton = document.getElementById("direction-styled-tab");
        const directionTab = document.getElementById("styled-direction");



        delegationButton.addEventListener("click",function(){
            localStorage.setItem('viewTab','delegation');
            toggleTab();
        })

        approverButton.addEventListener("click", function() {
            localStorage.setItem('viewTab', 'approver');
            toggleTab();
        });

        userButton.addEventListener("click", function() {
            localStorage.setItem('viewTab', 'user');
            toggleTab();
        });

        directionButton.addEventListener("click", function() {
            localStorage.setItem('viewTab', 'direction');
            toggleTab();
        });

        function toggleTab() {
            const viewTab = localStorage.getItem('viewTab');
            if (viewTab === 'user') {
                approverButton.setAttribute('aria-selected', false);
                userButton.setAttribute('aria-selected', true);
                userTab.classList.remove('hidden');
                approverTab.classList.add('hidden');
                delegationButton.setAttribute('aria-selected',false);
                delegationTab.classList.add('hidden');
            }else if (viewTab == 'delegation'){
                approverButton.setAttribute('aria-selected', false);
                userButton.setAttribute('aria-selected', false);
                delegationButton.setAttribute('aria-selected',true);
                userTab.classList.add('hidden');
                approverTab.classList.remove('hidden');
                approverTab.classList.add('hidden');
                directionButton.setAttribute('aria-selected',false);
                directionTab.classList.add('hidden');
            }else if (viewTab == 'direction') {
                approverButton.setAttribute('aria-selected', false);
                userButton.setAttribute('aria-selected', false);
                delegationButton.setAttribute('aria-selected',false);
                userTab.classList.add('hidden');
                approverTab.classList.add('hidden');
                directionButton.setAttribute('aria-selected', true);
                directionTab.classList.remove('hidden');
            } else {
                approverButton.setAttribute('aria-selected', true);
                userButton.setAttribute('aria-selected', false);
                approverTab.classList.remove('hidden');
                userTab.classList.add('hidden');
                delegationButton.setAttribute('aria-selected',false);
                delegationTab.classList.add('hidden');
                directionButton.setAttribute('aria-selected',false);
                directionTab.classList.add('hidden');
            }
        }
        toggleTab();
    </script>
</x-app-layout>
