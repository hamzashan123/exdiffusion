@extends('layouts.admin')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Registered Users
            </h6>
            <div class="ml-auto">
                @can('create_user')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    
                        <span class="text">Add user</span>
                    </a>

                    
                @endcan
            </div>
        </div>
        <!-- @include('partials.backend.filter', ['model' => route('admin.users.index')]) -->

        <div class="table-responsive">
            <table class="table table-hover" id="usersTable">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Occupation</th>
                    <!-- <th>Username</th> -->
                    
                    <!-- <th>Created at</th> -->
                    <th class="text-center" style="width: 30px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>

                        <td> {{ $user->email }}</td>
                        <td> {{ $user->country }}</td>
                        <td> {{ $user->occupation }}</td>
                        <!-- <td>
                            @if($user->user_image)
                                <img src="{{ asset('storage/images/users/' . $user->user_image) }}" alt="{{ $user->full_name }}" class="img-profile rounded-circle">
                            @else
                                <img src="{{ asset('img/avatar.png') }}" alt="{{ $user->full_name }}" width="60" height="60">
                            @endif
                        </td> -->
                        <!-- <td>
                            
                            <strong>{{ $user->username }} </strong>
                        </td> -->
                        
                       
                         
                        
                        <!-- <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '' }}</td> -->
                        <td>
                            <div class="btn-group btn-group-sm actionbtn">
                                <!-- <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a> -->
                                <a href="javascript:void(0);"
                                   onclick="if (confirm('Are you sure to delete this record?'))
                                       {document.getElementById('delete-tag-{{ $user->id }}').submit();} else {return false;}"
                                   class="btn btn-sm btn-danger decline">
                                   Delete
                                    <!-- <i class="fa fa-trash"></i> -->
                                </a>
                            </div>
                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  id="delete-tag-{{ $user->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                
                    
                @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#usersTable').DataTable( {
            lengthChange: false
        });
    });
</script>