@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Name</th><th>Middlename</th><th>Surname</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->id }}</td> <td> {{ $user->name }} </td><td> {{ $user->middlename }} </td><td> {{ $user->surname }} </td>
                </tr>
            </tbody>    
        </table>
    </div>
</div>
@endsection