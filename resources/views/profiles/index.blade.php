@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline pb-3">
                <div class="d-flex align-items-center">
                    <div class="h4">{{$user->username}}</div>
                       
                    <div id="app">
                        <follow-button></follow-button>
                        <button class="btn btn-primary ms-4">Follow</button>
                    </div>          
                    {{-- This will refere to the FollowButton.vue, where I moved the button --}}
                    {{-- TODO: Not working, will have to get back to it --}}

                </div>
                
                @can('update', $user->profile)
                <a class="btn btn-primary btn-sm" href="/post/create" role="button">Add New Post</a>
                @endcan
                
            </div>
            
            @can('update', $user->profile)
                <a href='/profile/ {{ $user->id }} /edit'>Edit Profile</a>
                 {{--@can shows or hides the data within IF user can update  --}}
            @endcan
            
            <div class="d-flex">
                <div class="pe-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pe-5"><strong>1,299</strong> followers</div>
                <div class="pe-5"><strong>248</strong> following</div>
            </div>
            <div class="pt-4"><strong>{{ $user->profile->title ?? 'Insert title' }}</strong></div>
            <div>
                {{$user->profile->description ?? 'No description' }}
            </div>
            <div><a href="#">{{$user->profile->url ?? 'No URL'}}</a></div>
        </div>

        <div class="row pt-5">
            @foreach($user->posts as $post)

            <div class="col-4 pb-4">
                <a href="/post/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100"> 
                </a>
                  
            </div>

            @endforeach   
        </div>
    </div>
</div>
@endsection
