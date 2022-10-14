@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(isset($zohoData['requestAuth']) && $zohoData['requestAuth'])
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ $zohoData['requestAuth'] }}" class="underline text-gray-900 dark:text-white">Zoho get auth</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($zohoData['indexContract']) && $zohoData['indexContract'])
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ route('contract.index') }}" class="underline text-gray-900 dark:text-white">Zoho index contract</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($zohoData['createContract']) && $zohoData['createContract'])
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ route('contract.create') }}" class="underline text-gray-900 dark:text-white">Zoho create contract</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
                @if(isset($zohoData['createDeals']) && $zohoData['createDeals'])
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ route('deals.create') }}" class="underline text-gray-900 dark:text-white">Zoho create deal</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
