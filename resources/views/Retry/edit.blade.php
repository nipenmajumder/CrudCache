@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('retry.update',$edit_data->r_id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{$edit_data->name}}" name="name" value="{{ old('title') }}">
                            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Roll</label>
                            <input type="text" class="form-control" value="{{$edit_data->roll}}" name="roll" value="{{ old('roll') }}">
                            <small class="form-text text-danger">{{ $errors->first('roll') }}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection