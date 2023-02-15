@extends('layouts.admin')

@section('title') List of categories  @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')

        <blockquote>Categories</blockquote>

        <a class= "waves-effect waves-dark green btn btn-medium right" href="{{route('category.create')}}">ADD<i class="material-icons white-text right">add</i></a>
        <br>

        <table class="striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Number of articles</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr>
                        <td>{{$category->title}}</td>
                        <td>{{count($category->posts)}}</td>
                        <td>

                            <a class= "btn waves-effect btn-small green" href="{{route('category.edit', $category->id)}}">
                                <i class="material-icons white-text">edit</i>
                            </a>

                            <form id="delete-form-{{$category->id}}" action="{{route('category.destroy',$category->id)}}" method="POST"  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <a class= "btn waves-effect btn-small red" onclick="if(confirm('Do you really want to delete this category ?')) {event.preventDefault();
                                                     document.getElementById('delete-form-{{$category->id}}').submit();}"><i class="material-icons white-text">delete</i></a>
                            </form>
             
                        </td>
                    </tr>

                @empty

                    <div class="center"><span class="grey-text">No category specified for the moment...</span></div>

              @endforelse

            </tbody>
        </table>

        {{$categories->links()}}

    </div>

@endsection

@push('js')

    @include('layouts.partials._notification')


@endpush