<x-app-layout>
    <x-slot name="header">
        <div class="px-6 flex justify-between items-center space-x-2">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Approbateurs') }}
            </h2>
        </div>
    </x-slot>
    <div>
        @if (session()->has('message'))
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
                        {{session()->get('message')}};
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            @if(session()->has('error'))
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
                        {{session()->get('error')}}
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
    </div>
    <div class="flex justify-end my-2">
        <button  id="add" class=" px-2 py-2 text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm dark:bg-emerald-700 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">
            Add approver
    </button>
    </div>
    <form action="{{route('approbateurs.store')}}" method="post">
        @csrf
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-2.5">
                            Level
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            fonction
                        </th>
                        <th scope="col" class="px-6 py-3">
                            email
                        </th>
                        <th scope="col" class="p-6 flex justify-between items-center space-x-2">
                            <div >
                                Actions
                            </div>
                            <div>
                            <a id="enableAllBtn" onclick="editAction()" class="px-2 py-2 text-white bg-blue-800 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-700 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    @foreach ($approbateurs as $approbateur)
                        <tr data-id="{{ $approbateur->id }}" class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row">
                                <input type="number" value="{{$approbateur->level}}" name="level[]" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            </th>
                            <td>
                                <input type="text" name="name[]" value="{{$approbateur->name}} " class="in name_approver bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            </td>
                            <td>
                                <input type="text" name="fonction[]" value="{{$approbateur->fonction}}" class="in  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            </td>
                            <td>
                                <input type="text" name="email[]" value="{{$approbateur->email}}" class="in bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            </td>
                            <td class="flex items-center mx-4 space-x-10">
                                <a onclick="supprimer(event);" class="text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm ps-2 px-2.5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"
                                data-modal-target="delete-modal"
                                data-modal-toggle="delete-modal"
                                href="{{ route('approbateurs.destroy', $approbateur->id) }}"
                                data-id="{{ $approbateur->id }}" >
                                    Delete
                                </a>
                                <a href="" class="pe-8">
                                    <svg class=" w-6 h-6 justify-center items-center text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20V7m0 13-4-4m4 4 4-4m4-12v13m0-13 4 4m-4-4-4 4"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                            <input type="hidden" name="id[]" value="{{$approbateur->id}}">
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div class=" flex justify-end space-x-2">
            <button type="button" id="saveBtn" class=" px-4 py-2 bg-green-800 text-white rounded" style="display:none;">Save</button>
            <button id="create"  type="submit" class=" px-4 py-2  bg-blue-500 text-white rounded" style="display: none;">Create</button>
        </div>
    </form>
    <div>
        <x-deleteApprobateur/>
    </div>
    <!--Scripts-->
    <script src="https:ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
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
                        url: '{{route('update.levels')}}',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            approbateurIds: approbateurIds,
                        },
                        success: function(response) {
                        if (response.data) {
                            $('#sortable').empty();
                            $.each(response.data, function(index, approbateur) {
                                var newRow =  `
                                <tr data-id="${approbateur.id}" class="space-x-4 bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row">
                                        <input type="number" value="${approbateur.level}" name="level[]" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    </th>
                                    <td>
                                        <input type="text" name="name[]" value="${approbateur.name}" class="in name_approver bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    </td>
                                    <td>
                                        <input type="text" name="fonction[]" value="${approbateur.fonction}" class="in  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    </td>
                                    <td>
                                        <input type="text" name="email[]" value="${approbateur.email}" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    </td>
                                    <td class="flex items-center mx-4 space-x-10">
                                        <a onclick="supprimer(event);" class="text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm ps-2 px-2.5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"
                                        data-modal-target="delete-modal"
                                        data-modal-toggle="delete-modal"
                                        href="{{ route('approbateurs.destroy', $approbateur->id) }}"
                                        data-id="{{ $approbateur->id }}" >
                                            Delete
                                        </a>
                                        <a href="" class="pe-8">
                                            <svg class=" w-6 h-6 justify-center items-center text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20V7m0 13-4-4m4 4 4-4m4-12v13m0-13 4 4m-4-4-4 4"/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                    <input type="hidden" name="id[]" value="{{$approbateur->id}}">
                                    </td>
                                </tr>`;
                                $('#sortable').append(newRow);
                            });
                        } else {
                            console.log('Erreur : Aucune donnée retournée.');
                        }
                    },
                        error: function(xhr, status, error) {
                            console.error('Erreur AJAX : ' + error);
                        }
                    });
                }
            });
        });
        function editAction() {
            var inputs = document.querySelectorAll('.in');
            inputs.forEach(function(input) {
                input.removeAttribute('disabled');
            });
            document.getElementById('saveBtn').style.display = 'block';
            document.getElementById('create').style.display = 'none';   
            $('tr.new-row').remove();// supprimer les lignes ajoutées si elles ne sont pas valider
        }
        $(document).ready(function() {
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
                        <th scope="row">
                            <input type="hidden" name="level[]" value="${i}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </th>
                        <td>
                            <input type="text" name="name[]" class="name-approver bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </td>
                        <td>
                            <input type="text" name="fonction[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </td>
                        <td>
                            <input type="email" name="email[]" class="email-approver bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </td>
                        <td dir="rtl" >
                            <button type="button" class="delete text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800" >
                                Cancel
                            </button>
                        </td>
                    </tr>
                `;
                $("tbody").append(tr);
                }
            });
                $('tbody').on('click','.delete',function(){
                    $(this).closest('tr').remove();
                    var a = document.getElementById('sortable');
                    var b = a.rows.length;
                    var i = b+1;
                    if(b == 4 && $a == true ){
                        document.getElementById('add').style.display = 'none';
                    }else{
                    document.getElementById('add').style.display = 'block';
                    document.getElementById('create').style.display = 'none';
                }
                });
                var users = @json($users); 
                var userData = {}; 
                users.forEach(function(user) {
                    userData[user.name] = user.email; 
                });
            $('tbody').on('focus', '.name-approver, .email-approver', function() {
                var current_Input = $(this); 
                current_Input.autocomplete({
                    source: function(request, response) {
                        var term = request.term.toLowerCase();
                        var filtreItems = Object.keys(userData).filter(function(key) {
                            return key.toLowerCase().indexOf(term) !== -1 || userData[key].toLowerCase().indexOf(term) !== -1;
                        });
                        response(filtreItems); 
                    },
                    select: function(event, ui) {
                        var selectionneValue = ui.item.value; 
                        current_Input.val(selectionneValue);
                        if (current_Input.hasClass('name-approver')) {
                            var selectionneEmail = userData[selectionneValue]; 
                            current_Input.closest('tr').find('.email-approver').val(selectionneEmail); 
                        }
                    }
                });
            });
        });
        // update avec ajax
        $('#saveBtn').click(function() {
        $('#add').show();
        $('input').prop('disabled', true);
        $('#saveBtn').hide( "drop", { direction: "down" }, "slow" );
        var approbateurs = [];
        $('tbody tr').each(function() {
            var id = $(this).data('id');
            var level = $(this).find('input[name="level[]"]').val();
            var name = $(this).find('input[name="name[]"]').val();
            var fonction = $(this).find('input[name="fonction[]"]').val();
            var email = $(this).find('input[name="email[]"]').val();
            approbateurs.push({
                id: id,
                level: level,
                name: name,
                fonction: fonction,
                email: email
            });
        });
        $.ajax({
            url: "approbateurs/update",
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify({approbateurs: approbateurs}),
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                console.log('Une erreur s\'est produite lors de la sauvegarde des modifications');
            }
        });
    });

</script>

</x-app-layout>