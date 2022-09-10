@extends('layouts.adminmain')
@section('content')
    <div class="card-body">
        <h4 class="card-title">User Table</h4>
        <p class="card-description"> <code>Hello {{ Auth::user()->name }} </code><br>
            @if(session('success'))
                <code class="text-success">>> {{session('success')}}</code>
            @endif
        </p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> User </th>
                        <th> Email </th>
                        <th> Role </th>
                        <th> Created at </th>
                        <th> Updated at </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-light">
                            <td> {{ $user->name }} </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->user_role == '1')
                                    <span class="badge badge-primary">Admin</span>
                                @else
                                    <span class="badge badge-secondary text-black">User</span>
                                @endif
                            </td>
                            <td> {{$user->created_at->format('d-m-Y | h:i:s A')}}</td>
                            <td> {{$user->updated_at->format('d-m-Y | h:i:s A')}}</td>
                            <td>
                                <a href="{{ url('admin/edit/user?id=' . $user->id) }}"><i
                                        class="mdi mdi-pencil fs-5 mx-2 text-primary"></i></a>
                                <a href="" class="delSubmit"><i class="mdi mdi-delete fs-5 mx-2 text-danger"></i></a>
                                <form action="{{route('admin#delete_user')}}" method="POST" class="d-none delUserForm">
                                    @csrf
                                    @method('delete')
                                    <input type="text" value="{{$user->id}}" name="id">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.userList').addClass('active');
        });
        $('.delSubmit').click(function (e) {
            e.preventDefault();
            if (confirm('Are you sure to delete?')) {
                $('.delUserForm').submit();
            }
        });
    </script>
@endpush
