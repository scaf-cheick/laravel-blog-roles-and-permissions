@extends('layouts.admin')

@section('title') List of posts  @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')

        <blockquote>Posts</blockquote>

        @can('edit_articles')
            <a class= "waves-effect waves-dark green btn btn-medium right" href="{{route('post.create')}}">ADD<i class="material-icons white-text right">add</i></a>
            <br>
        @endcan
        

        <table class="striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Initiator</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($posts as $post)

                    <tr>
                        <td><img src="{{ $post->banner != "" ?  asset('uploads/'. $post->banner) : asset('images/logo.png') }}" alt="" class="circle materialboxed" height="40" width="40"></td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category->title}}</td>
                        <td>{{$post->initiator->name}}</td>
                        <td><b>{{$post->status ? 'published' : 'draft'}}</b></td>
                        <td>
                            <a class= "btn waves-effect btn-small green modal-trigger" href="#PostShow{{$post->id}}">
                                <i class="material-icons white-text">remove_red_eye</i>
                            </a>

                            @include('layouts.partials.modals._post')

                            @can('publish_articles')
                                <a class= "btn waves-effect btn-small green" href="{{route('post.publish', $post->id)}}">
                                    <i class="material-icons white-text">@if($post->status) network_wifi @else signal_wifi_off @endif</i>
                                </a>
                            @endcan

                            @can('edit_articles')

                                <a class= "btn waves-effect btn-small green" href="{{route('post.edit', $post->id)}}">
                                    <i class="material-icons white-text">edit</i>
                                </a>

                            @endcan

                            @can('delete_articles')

                                <form id="delete-form-{{$post->id}}" action="{{route('post.destroy',$post->id)}}" method="POST"  style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <a class= "btn waves-effect btn-small red" onclick="if(confirm('Do you really want to delete this post?')) {event.preventDefault();
                                                     document.getElementById('delete-form-{{$post->id}}').submit();}"><i class="material-icons white-text">delete</i></a>
                                </form>
                            @endcan
             
                        </td>
                    </tr>

                @empty

                    <div class="center"><span class="grey-text">No post specified for the moment...</span></div>

              @endforelse

            </tbody>
        </table>

        {{$posts->links()}}

    </div>

@endsection

@push('js')

    @include('layouts.partials._notification')


@endpush