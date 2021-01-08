@extends('back.layouts.master')
@section('title','Settings')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('admin.config.update')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Title</label>
                        <input type="text" name="title" required class="form-control" value="{{$config->title}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site activity status</label>
                        <select class="form-control" name="active">
                            <option @if ($config->active==1) selected @endif value="1">Open</option>
                            <option @if ($config->active==0) selected @endif value="0">Closed</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Logo</label>
                        <input type="file" class="form-control" name="logo">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Site Favicon</label>
                            <input type="file" class="form-control" name="favicon">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Facebook</label>
                        <input type="text" class="form-control" name="facebook" value="{{$config->facebook}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Twitter</label>
                            <input type="text" class="form-control"  name="twitter" value="{{$config->twitter}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Github</label>
                        <input type="text" class="form-control" name="github" value="{{$config->github}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">LinkIn</label>
                            <input type="text" class="form-control"  name="linkedin" value="{{$config->linkedin}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Youtube</label>
                        <input type="text" class="form-control" name="youtube" value="{{$config->youtube}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Instagram</label>
                            <input type="text" class="form-control"  name="instagram" value="{{$config->instagram}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-md btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
 
@endsection
