@extends('front.layouts.master')
@section('title','contact')
@section('bg','https://startbootstrap.github.io/startbootstrap-clean-blog/img/contact-bg.jpg')
@section('content')

<div class="col-md-8">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>    
  @endif
  <p>Contact me</p>
<form method="POST" action="{{route('contact.post')}}">
  @csrf
    <div class="control-group">
      <div class="form-group controls">
        <label>Name/Surname</label>
      <input type="text" class="form-control" placeholder="Name/Surname" value="{{old('name')}}" name="name" required >
      </div>
    </div>
    <div class="control-group">
      <div class="form-group controls">
        <label>Email Address</label>
        <input type="email" class="form-control" placeholder="Email Address" value="{{old('email')}}" name="email" required >
      </div>
    </div>
    <div class="control-group">
      <div class="form-group col-xs-12 controls">
        <label>Topic</label>
        <select class="form-control" name="topic">
          <option @if (old('topic')=='Information') selected @endif>Information</option>
          <option @if (old('topic')=='Support') selected @endif>Support</option>
          <option @if (old('topic')=='General') selected @endif>General</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <div class="form-group controls">
        <label>Message</label>
        <textarea rows="5" class="form-control" placeholder="Message" name="message" required >{{old('message')}}</textarea>
      </div>
    </div>
    <br>
    <div id="success"></div>
    <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
  </form>
</div>
<div class="col-md-4">
  <div class="card card-default">
    <div class="card-body">Panel Content</div>
    Adres : njds dcnskj 
  </div>
</div>

@endsection



