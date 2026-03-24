@extends('layouts.app')

@section('content')

<div class="container">
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الصلاحيات</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الصلاحيات</span>
            </div>
        </div>
    </div>
</div>

@if (count($errors) > 0)
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>خطأ</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">

                <div class="form-group mb-3">
                    <p>اسم الصلاحية :</p>
                    {!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control']) !!}
                </div>

                <div class="col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            الصلاحيات
                            <button class="btn btn-sm btn-link float-right" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#permissions-list">
                                عرض الصلاحيات
                            </button>

                            <ul class="collapse mt-2 list-group" id="permissions-list">
                                @foreach($permission as $value)
                                    <li class="list-group-item">
                                        <label>
                                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), ['class' => 'name']) }}
                                            {{ $value->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-main-primary">تحديث</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->

{!! Form::close() !!}

@endsection