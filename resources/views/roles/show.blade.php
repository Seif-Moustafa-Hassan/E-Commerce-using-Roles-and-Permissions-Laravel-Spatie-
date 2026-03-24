@extends('layouts.app')

@section('content')

<div class="container">
    <h4>صلاحيات المستخدمين</h4>

    <ul class="list-group">
        <li class="list-group-item">
            {{ $role->name }}
            <button class="btn btn-sm btn-link float-right" data-bs-toggle="collapse" data-bs-target="#permissions-{{ $role->id }}">
                عرض الصلاحيات
            </button>
            <ul class="collapse mt-2" id="permissions-{{ $role->id }}">
                @foreach($rolePermissions as $permission)
                    <li class="list-group-item">{{ $permission->name }}</li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>

@endsection