@extends('layouts.admin')

@section('title') List of role  @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')

        <blockquote>Roles</blockquote>

        <a class= "waves-effect waves-dark green btn btn-medium right" href="{{route('role.create')}}">ADD<i class="material-icons white-text right">add</i></a>
        <br>

        <table class="striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Associated permissions</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($roles as $role)

                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            @if($role->name == 'super_admin')
                                all granted
                            @else
                                @forelse($role->permissions as $permission) {{$permission->name.' - '}}  @empty aucune permission @endforelse
                            @endif
                        </td>
                        <td>

                            <a class= "btn waves-effect btn-small green" href="{{route('role.edit', $role->id)}}">
                                <i class="material-icons white-text">edit</i>
                            </a>

                            <form id="delete-form-{{$role->id}}" action="{{route('role.destroy',$role->id)}}" method="POST"  style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <a class= "btn waves-effect btn-small red" onclick="if(confirm('Do you really want to delete this permission?')) {event.preventDefault();
                                                 document.getElementById('delete-form-{{$role->id}}').submit();}"><i class="material-icons white-text">delete</i></a>
                          </form>
             
                        </td>
                    </tr>

                @empty

                    <div class="center"><span class="grey-text">No role specified for the moment...</span></div>

              @endforelse

            </tbody>
        </table>

        {{$roles->links()}}

    </div>

@endsection

@push('js')

    @include('layouts.partials._notification')


@endpush