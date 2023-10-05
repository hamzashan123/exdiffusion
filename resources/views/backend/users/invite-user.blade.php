@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">
            Invitation Request
        </h6>

    </div>
    <!-- @include('partials.backend.filter', ['model' => route('admin.users.index')]) -->

    <div class="table-responsive">
        <table class="table table-hover" id="invitationTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Occupation</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 30px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invites as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>

                    <td> {{ $user->email }}</td>

                    <td>

                        {{ $user->country }}
                    </td>



                    <td>{{ $user->occupation }}</td>
                    @if($user->status == 'pending')
                    <td>
                        <div class="badge-container">
                            <span class="badge bg-warning text-white">{{ $user->status }}</span>
                        </div>
                    </td>

                    @elseif($user->status == 'approved')
                    <td>
                        <div class="badge-container">
                            <span class="badge bg-success text-white">{{ $user->status }}</span>
                        </div>
                    </td>
                    @elseif($user->status == 'declined')
                    <td>
                        <div class="badge-container">
                            <span class="badge bg-danger text-white">{{ $user->status }}</span>
                        </div>
                    </td>

                    @endif

                    <!-- <td>
                            <div class="btn-group btn-group-sm actionbtn">
                                <a  href="#" class="approve btn btn-sm btn-primary">
                                   Approve
                                </a>
                                <a  href="#"
                                   class="btn btn-sm btn-danger decline">
                                    Decline
                                </a>
                            </div>
                            
                        </td> -->

                    <td>
                        <div class="btn-group btn-group-sm actionbtn">
                            @if($user->status == 'pending')
                            <a href="{{route('admin.inviteStatus',['id' => $user->id , 'status' => 'approved'])}}" class="approve btn btn-sm btn-primary">
                                Approve
                            </a>

                            <a href="{{route('admin.inviteStatus',['id' => $user->id , 'status' => 'declined'])}}" class="btn btn-sm btn-danger decline">
                                Decline
                            </a>
                            @endif
                        </div>

                    </td>
                </tr>


                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $('#invitationTable').DataTable( {
            lengthChange: false
         });
    });
</script>

@if(session('success'))
<script>
    $(document).ready(function() {
        

        Swal.fire({
            title: '<?php echo session('success') ?>',
            icon: 'success',
            timer: 4000, // Auto-close the alert after 4 seconds
            showConfirmButton: false
        });
    })
</script>
@endif

@if(session('failed'))
<script>
    $(document).ready(function() {
        Swal.fire({
            title: '<?php echo session('failed') ?>',
            icon: 'error',
            timer: 4000, // Auto-close the alert after 4 seconds
            showConfirmButton: false
        });
    })
</script>
@endif