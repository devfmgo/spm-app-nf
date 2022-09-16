@extends('layouts.app')
@section('title','SPM | Users Account')
@section('content')
<div class="w-full xl:w-11/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-bold text-gray-700 text-3xl p-2">Data User Account</h3>

                </div>
                <div class=" relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                    <a href="/register"
                        class="bg-blue-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button">Add New Account</a>
                </div>
            </div>
        </div>

        <div class="block w-full overflow-x-auto">
            <table class="items-center bg-transparent w-full border-collapse ">
                <thead>
                    <tr>
                        <th
                            class="px-6 bg-gray-100 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            #
                        </th>
                        <th
                            class="px-6 bg-gray-100 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Name
                        </th>
                        <th
                            class="px-6 bg-gray-100 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Email
                        </th>
                        <th
                            class="px-6 bg-gray-100 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Role
                        </th>

                        <th
                            class="px-6 bg-gray-100 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Action
                        </th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)

                    <tr>

                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">
                            {{$loop->iteration}}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">
                            {{$user->name}}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">
                            {{$user->email}}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">

                            @if ($user->is_admin)
                            <div
                                class=" text-gray-600 bg-green-300 text-xs p-2 rounded-full font-semibold w-28 text-center">
                                Administrator</div>
                            @else
                            <div
                                class=" text-gray-600 bg-indigo-300 text-xs p-2 rounded-full font-semibold w-28 text-center">
                                User
                            </div>
                            @endif
                        </td>

                        <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-sm whitespace-nowrap p-4">

                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    {{$users->links()}}
</div>
@endsection