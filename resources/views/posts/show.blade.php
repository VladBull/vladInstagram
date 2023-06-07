@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pe-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width:40px">
                    </div>
                    <div>
                        <div class="fw-bold">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a> *
                            <a href="#" class="ps-1">Follow</a>                          
                        </div>
                    </div>
                </div>

                <hr>
                                
                <p>
                    <span class="fw-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span> {{ $post->caption }}
                </p>
                
                @can('delete', $post)
                    <div>
                        <form method="POST" action="{{ route('posts.delete', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button class='btn btn-sm btn-danger text-white' type="submit">Delete</button>
                        </form>
                    </div>
                @endcan
                
            </div>
        </div>
    </div>
    
</div>
@endsection
