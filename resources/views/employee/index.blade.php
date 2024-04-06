@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Employee') }}
                    <!-- Modal toggle -->
                    <button id="employee_add_btn" data-custom-action="{{route('country-all')}}" data-modal-target="employee_add-modal" data-modal-toggle="employee_add-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                      Add Employee
                    </button>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Main modal -->
<div id="employee_add-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <form id="employee_add_form" name="employee_add_form" action="{{route('employee-add')}}" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="mode" id="mode" value="add"/>
                <input type="hidden" name="id" id="id" value=""/>
                <input type="hidden" name="edit_country_id" id="edit_country_id" value=""/>
                <input type="hidden" name="edit_state_id" id="edit_state_id" value=""/>
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add Employee
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="employee_add-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="">
                    <label for="employee_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee name</label>
                    <input type="text" id="employee_name" name="employee_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" required />
                </div>
                <div class="">
                    <label for="employee_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee email</label>
                    <input type="email" id="employee_email" name="employee_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
                </div>
                <div class="">
                    <label for="employee_country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee country</label>
                    <select id="employee_country" data-custom-action="{{route('states-country-all')}}" name="employee_country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option>Select Country</option>
                      </select>
                </div>
                <div class="">
                    <label for="employee_state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee state</label>
                    <select id="employee_state" name="employee_state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option>Select State</option>
                      </select>
                </div>
                <div class="">
                    <div id="display_existing_img"></div>
                    <label for="employee_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee image</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="employee_image" name="employee_image" type="file" accept="image/png, image/jpeg" >
                    <div id="file-input-error" class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">Allowed : jpg,jpeg,png</div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush