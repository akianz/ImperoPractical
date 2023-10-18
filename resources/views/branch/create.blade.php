<!DOCTYPE html>
<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"rel="stylesheet">
<body>
<h2>Create Branch</h2>
<form action="{{ route('branch.store') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <label for="">Select Business</label>
    <select class="form-select form-control" aria-label="Default select example" name="business_id">
        <option selected value="">Select Business</option>
        @if (!empty($business_list))
        @foreach ($business_list as $uValue)
            <option value="{{ $uValue->id ?? '' }}">{{ $uValue->name ?? '' }}</option>
        @endforeach
        @endif
      </select>
    @if ($errors->has('business_id'))
        <span class="help-block">
            <span  style="color: red;" class='validate'>{{ $errors->first('business_id') }}</span>
        </span>
    @endif
</div>

</div class="form-group">
    <label for="">Name </label>
    <input type="text" class="form-control"  name="name"  placeholder="Enter Name" value="{{old('name')}}" maxlength="250">
    @if ($errors->has('name'))
        <span class="help-block">
            <span  style="color: red;" class='validate'>{{ $errors->first('name') }}</span>
        </span>
    @endif
  </div>
  <div class="form-group">
    <label for="">Images </label>
    <input type="file" name="images[]" class="form-control" multiple>
    @if ($errors->has('images'))
        <span class="help-block">
            <span  style="color: red;" class='validate'>{{ $errors->first('images') }}</span>
        </span>
    @endif
  </div>
    <div class="form-group" style="position: relative">
        <label for="">Monday </label>
        <input type="text" name="week[Monday][start_time]" class="start_time">
        <input type="text" name="week[Monday][end_time]" class="end_time">
        <label for="">open/close </label>
        <input type="checkbox" name="week[Monday][opening_status]" >
    </div>
    <div class="form-group" style="position: relative">
        <label for=""> Tuesday</label>
        <input type="text" name="week[Tuesday][start_time]" class="start_time">
        <input type="text" name="week[Tuesday][end_time]" class="end_time">
        <label for="">open/close </label>
        <input type="checkbox" name="week[Tuesday][opening_status]" >
    </div>
    <div class="form-group" style="position: relative">
        <label for="">wednesday </label>
        <input type="text" name="week[Wednesday][start_time]" class="start_time">
        <input type="text" name="week[Wednesday][end_time]" class="end_time">
        <label for="">open/close </label>
        <input type="checkbox" name="week[Wednesday][opening_status]" >
    </div>
    <div class="form-group" style="position: relative">
        <label for="">thursday </label>
        <input type="text" name="week[Thursday][start_time]" class="start_time">
        <input type="text" name="week[Thursday][end_time]" class="end_time">
        <label for="">open/close </label>
        <input type="checkbox" name="week[Thursday][opening_status]" >

    </div>
    <div class="form-group" style="position: relative">
        <label for="">friday </label>
        <input type="text" name="week[Friday][start_time]" class="start_time">
        <input type="text" name="week[Friday][end_time]" class="end_time">
        <label for="">open/close </label>
        <input type="checkbox" name="week[Friday][opening_status]" >

    </div>
    <div class="form-group" style="position: relative">
        <label for="">saturday </label>
        <input type="text" name="week[Saturday][start_time]" class="start_time">
        <input type="text" name="week[Saturday][end_time]" class="end_time">
        <label for="">open/close </label>
        <input type="checkbox" name="week[Saturday][opening_status]" >

    </div>
    <div class="form-group" style="position: relative">
        <label for="">sunday </label>
        <input type="text" name="week[Sunday][start_time]" class="start_time">
        <input type="text" name="week[Sunday][end_time]" class="end_time">
        <label for="">open/close </label>
        <input type="checkbox" name="week[Sunday][opening_status]" >
    </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
</script>
<script>
    $('.start_time , .end_time').datetimepicker({
            format: 'hh:mm a'
    });

</script>
</html>

