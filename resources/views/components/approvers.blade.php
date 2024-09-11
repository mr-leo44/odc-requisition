@props(['approbateurs'])
<div class="hidden p-4 rounded-lg" id="styled-approver" role="tabpanel" aria-labelledby="approver-tab">
    
    <div>
        @if (session()->has('message'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="flex justify-between ms-3 text-sm font-medium">
                    {{ session()->get('message') }};
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
        @endif
        @if (session()->has('error'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session()->get('error') }}
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
        @endif
    </div>


    <div class="">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class=" font-bold text-base dark:text-white">Approbateurs</h3>
                </div>
                <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                    <div class="flex justify-end my-2 space-x-1">
                        <button id="add">
                            <svg class="w-[44px] h-[44px] text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                              </svg>                              
                        </button>
                        <a  onclick="editAction()"
                            class=" px-2 py-2  text-gray-400 hover:text-gray-100  mx-2">
                            <svg class="w-[48px] h-[48px] text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                            </svg>                              
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="block w-full overflow-x-auto mt-3 dark:bg-gray-800 rounded-xl">
            <form action="{{ route('approbateurs.store') }}" method="post">
                @csrf
                <table class="table w-full text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="dark:bg-gray-800 text-gray-500">
                        <tr class="text-black dark:text-white">
                            <th class="p-3 text-left"></th>
                            <th class="p-3 text-left">Noms</th>
                            <th class="p-3 text-left">Fonctions</th>
                            <th class="p-3 text-left"></th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($approbateurs as $approbateur)
                            <tr data-id="{{ $approbateur->id }}" class="dark:bg-gray-800">
                                <td class="p-3">
                                    <input type="number" value="{{ $approbateur->level }}" name="level[]"
                                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        style="display: none;"disabled>
                                </td>
                                <td class="p-3">
                                    <input type="text" name="name[]" value="{{ $approbateur->name }} "
                                        class="in name_approver bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        disabled>
                                </td>
                                <td class="p-3 font-bold">
                                    <input type="text" name="fonction[]" value="{{ $approbateur->fonction }}"
                                        class="in  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        disabled>
                                </td>
                                <td class="p-3">
                                    <input type="hidden" name="email[]" value="{{ $approbateur->email }}"
                                        class="in bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        disabled>
                                </td>
                                <td class="flex space-x-4 my-2 ">
                                    <a href="#" onclick="supprimer(event);" data-modal-target="delete-modal"
                                        data-modal-toggle="delete-modal"
                                        href="{{ route('approbateurs.destroy', $approbateur->id) }}"
                                        data-id="{{ $approbateur->id }}">
                                        <svg class="w-[32px] h-[32px] text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>                  
                                    </a>
                                    <a href="#">
                                        <svg class="my-0 w-[37px] h-[37px] text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m8 10 4-6 4 6H8Zm8 4-4 6-4-6h8Z"/>
                                        </svg>                                          
                                    </a>
                                </td>
                                <td>
                                    <input type="hidden" name="id[]" value="{{ $approbateur->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=" flex justify-end mx-14 py-3 space-x-2">
                    <button id="saveBtn" type="submit" class=" px-2 py-1 bg-orange-500 text-white rounded" style="display: none;">Save</button>
                    <button id="create" type="submit" class=" px-2 py-1 bg-orange-500 text-white rounded" style="display: none;">Create</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <x-deleteApprobateur/>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script>
        
        $(document).ready(function(){
            $("#sortable").sortable({
                helper:function(e, row){
                    var originalCells = row.children();
                    var cloneRow = row.clone();
                    cloneRow.children().each(function(index){
                        $(this).width($(originalCells[index]).width());
                    });
                    return cloneRow;
                },
                update: function(event, ui) {
                    var approbateurIds = [];
                    $('#sortable tr').each(function() {
                        approbateurIds.push($(this).data('id'));
                    });
                    $.ajax({
                        url: "{{route('update.levels')}}",
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            approbateurIds: approbateurIds,
                        },
                        success: function(response) {
                            if (response.data) {
                                console.log("Les niveaux ont été mis à jour avec succès");
                                
                    }},

                        error: function(xhr, status, error) {
                            console.error('Erreur AJAX : ' + error);}
                        
                });
                }
            });
        });
        function editAction() {
            var inputs = document.querySelectorAll('.in');
            inputs.forEach(function(input) {
                input.removeAttribute('disabled');
            });
            var a = document.getElementById('sortable');
            var b = a.rows.length
            if (b == 0) {
                document.getElementById('saveBtn').style.display = 'none';
            }else{
                document.getElementById('saveBtn').style.display = 'block';
                document.getElementById('create').style.display = 'none';   
                $('tr.new-row').remove();// supprimer les lignes ajoutées si elles ne sont pas valider
            }
        }
        $(document).ready(function(event) {
            $("#add").click(function() {
                var a = document.getElementById('sortable');
                var b = a.rows.length;
                var i = b+1;
                if(b == 4){
                    document.getElementById('add').style.display = 'none';
                }else{
                document.getElementById('create').style.display = 'block';
                document.getElementById('saveBtn').style.display = 'none';
                var tr = `
                    <tr class="new-row ui-widget bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-3">
                            <input type="hidden" name="level[]" value="${i}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </td>
						<td class="p-3">
                            <input type="text" name="name[]" class="name-approver bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </td>
						<td class="p-3 font-bold">
						    <input type="text" name="fonction[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </td>
						<td class="p-3">
                            <input type="hidden" name="email[]" class="cursor-not-allowed email-approver bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required >
                        </td>
						<td class="p-3 ">
                            <button type="button" class="delete ">
                                <svg class="w-[36px] h-[36px] text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>

                            </button>
						</td>
					</tr>
                    
                `;
                        $("tbody").append(tr);
                    }
                });
                $('tbody').on('click', '.delete', function() {
                    $(this).closest('tr').remove();
                    var a = document.getElementById('sortable');
                    var b = a.rows.length;
                    var i = b + 1;
                    if (b == 4 && $a == true) {
                        document.getElementById('add').style.display = 'none';
                    } else {
                        document.getElementById('add').style.display = 'block';
                        document.getElementById('create').style.display = 'none';
                    }
                });
                // autocomplete avec l'API 
                fetch('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            var autocompleteData = data.users.reduce((acc, user) => {
                                acc[`${user.first_name} ${user.last_name}`] = user.email;
                                return acc;
                            }, {});
                            initAutocomplete(autocompleteData);
                        } else {
                            console.error('Erreur lors de la récupération des données :', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des données :', error);
                    });
                function initAutocomplete(data) {
                    $('tbody').on('focus', '.name-approver, .email-approver', function() {
                        var currentInput = $(this);
                        currentInput.autocomplete({
                            source: function(request, response) {
                                var term = request.term.toLowerCase();
                                var filteredItems = Object.keys(data).filter(function(key) {
                                        return key.toLowerCase().indexOf(term) !== -1 || data[
                                            key].toLowerCase().indexOf(term) !== -1;
                                    })
                                    .slice(0, 10) //limiter à 10
                                ;
                                response(filteredItems);
                            },
                            select: function(event, ui) {
                                var selectedValue = ui.item.value;
                                currentInput.val(selectedValue);
                                if (currentInput.hasClass('name-approver')) {
                                    var selectedEmail = data[selectedValue];
                                    currentInput.closest('tr').find('.email-approver').val(
                                        selectedEmail);
                                }
                            }
                        });
                    });
                }
            });

            $('#saveBtn').click(function(event) {
                
                event.preventDefault();

                $('#add').show();
                $('input').prop('disabled', true);
                $('#saveBtn').hide("drop");

                var approbateurs = [];

                $('tbody tr').each(function() {
                    var id = $(this).find('input[name="id[]"]').val();
                    var name = $(this).find('input[name="name[]"]').val();
                    var email = $(this).find('input[name="email[]"]').val();
                    var fonction = $(this).find('input[name="fonction[]"]').val();
                    
                    approbateurs.push({
                        id: id,
                        name: name,
                        email: email,
                        fonction: fonction
                    });
                });

                $.ajax({
                    url: "{{route('approbateurs.updateAll')}}", 
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: 'application/json',
                    data: JSON.stringify({
                        approbateurs: approbateurs 
                    }),
                    success: function(response) {
                        console.log('Les modifications ont été sauvegardées avec succès');
                          // $('#message').html('<p  class="items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">Les modifications ont été sauvegardées avec succès.</p>');

                    },
                    error: function(xhr) {
                        console.log('Une erreur s\'est produite lors de la sauvegarde des modifications', xhr);
                    }
                });
            });
        </script>


</div>