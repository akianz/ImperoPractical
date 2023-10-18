<!DOCTYPE html>
<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"rel="stylesheet">
<body>
<h2>Create Business</h2>
<form action="{{ route('business.store') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <label for="">Business Name </label>
    <input type="text" class="form-control"  name="name"  placeholder="Enter Name" value="{{old('name')}}" maxlength="250">
    @if ($errors->has('name'))
        <span class="help-block">
            <span  style="color: red;" class='validate'>{{ $errors->first('name') }}</span>
        </span>
    @endif
  </div>
  <div class="form-group">
    <label for="">Email </label>
    <input type="text" class="form-control"  name="email"  placeholder="Enter Email" value="{{old('email')}}" maxlength="250">
    @if ($errors->has('email'))
        <span class="help-block">
            <span  style="color: red;" class='validate'>{{ $errors->first('email') }}</span>
        </span>
    @endif
  </div>
  <div class="form-group">
    <label for="">Phone Number </label>
    <input type="text" class="form-control"  name="phone"  placeholder="Enter Phone" value="{{old('phone')}}" maxlength="15">
    @if ($errors->has('phone'))
        <span class="help-block">
            <span  style="color: red;" class='validate'>{{ $errors->first('phone') }}</span>
        </span>
    @endif
  </div>
  <div class="form-group">
    <label for="">Logo </label>
    <input type="file" class="form-control" name="logo">
    @if ($errors->has('logo'))
        <span class="help-block">
            <span  style="color: red;" class='validate'>{{ $errors->first('logo') }}</span>
        </span>
    @endif
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

</html>

