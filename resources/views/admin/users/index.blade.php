@extends('layouts.admin')

@section('title') List of users  @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')

        <blockquote>Users</blockquote>

        <br>

        <table class="striped">
            <thead>
                <tr>
                    <th>Registration date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Associated roles</th>
                    <th>Number of articles</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>@forelse($user->roles as $role) {{$role->name.' - '}}  @empty empty role @endforelse</td>
                        <td>{{count($user->posts)}}</td>
                        <td>

                            @can('change_role')
                                <a class= "btn waves-effect btn-small green" href="{{route('user.edit', $user->id)}}">
                                    <i class="material-icons white-text">edit</i>
                                </a>
                            @endcan
             
                        </td>
                    </tr>

                @empty

                    <div class="center"><span class="grey-text">No user specified for the moment...</span></div>

              @endforelse

            </tbody>
        </table>

    </div>

@endsection

@push('js')

    @include('layouts.partials._notification')


@endpush