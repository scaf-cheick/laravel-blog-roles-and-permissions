@extends('layouts.admin')

@section('title') List of permissions  @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')

        <blockquote>Permissions</blockquote>

        <a class= "waves-effect waves-dark green btn btn-medium right" href="{{route('permission.create')}}">ADD<i class="material-icons white-text right">add</i></a>
        <br>

        <table class="striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($permissions as $permission)

                    <tr>
                        <td>{{$permission->name}}</td>
                        <td>

                            <a class= "btn waves-effect btn-small green" href="{{route('permission.edit', $permission->id)}}">
                                <i class="material-icons white-text">edit</i>
                            </a>

                            <form id="delete-form-{{$permission->id}}" action="{{route('permission.destroy',$permission->id)}}" method="POST"  style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <a class= "btn waves-effect btn-small red" onclick="if(confirm('Do you really want to delete this permission?')) {event.preventDefault();
                                                 document.getElementById('delete-form-{{$permission->id}}').submit();}"><i class="material-icons white-text">delete</i></a>
                          </form>
             
                        </td>
                    </tr>

                @empty

                    <div class="center"><span class="grey-text">No permission specified for the moment...</span></div>

              @endforelse

            </tbody>
        </table>

        {{$permissions->links()}}

    </div>

@endsection

@push('js')

    @include('layouts.partials._notification')


@endpush