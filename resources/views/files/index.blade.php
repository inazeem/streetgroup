@extends('app')

@section('content')

<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Files</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
       @if ( !$files->count() )
        You have no Files
        @else
        <ul role="list" class="divide-y divide-gray-100">
             <li class="flex justify-between gap-x-6 py-5">
                <div class="text-sm font-semibold leading-6 text-gray-900" >File Name</div>
                <div class="text-sm font-semibold leading-6 text-gray-900">Is Parsed?</div>
                <div class="text-sm font-semibold leading-6 text-gray-900">Actions</div>
            </li>
            @foreach( $files as $file )
            <li class="flex justify-between gap-x-6 py-5">
                <div >{{ $file->name }}</div>
                <div >{{ $file->is_parsed }}</div>
                <div ><a href="/parse/{{$file->id}}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Parse</a></div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
  </main>
@endsection


