<!DOCTYPE html>
<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
    <div>
        <div class="form-group">
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
    </div>
    <div>
        <div class="form-group" style="position: relative; display:flex;">
            <label for="">Monday </label>
            <div class="main_section">
                <div class="timer_div">
                    <input type="time" name="week[Monday][start_time][]" class="">
                    <input type="time" name="week[Monday][end_time][]" class="">
                </div>
            </div>
            <div class="plus_div">
                <a class="add_times"><i class="fa fa-plus"></i></a>
                <label for="">open/close </label>
                <input type="checkbox" name="week[Monday][opening_status]" >
            </div>
        </div>
        <div class="form-group" style="position: relative;display:flex;">
            <label for=""> Tuesday</label>
            <div class="main_section">
                <div class="timer_div">
                    <input type="time" name="week[Tuesday][start_time][]">
                    <input type="time" name="week[Tuesday][end_time][]" >
                </div>
            </div>
            <div class="plus_div">
                <a class="add_times"><i class="fa fa-plus"></i></a>
                <label for="">open/close </label>
                <input type="checkbox" name="week[Tuesday][opening_status]" >
            </div>
        </div>
        <div class="form-group" style="position: relative;display:flex;">
            <label for="">Wednesday </label>
            <div class="main_section">
                <div class="timer_div">
                    <input type="time" name="week[Wednesday][start_time][]">
                    <input type="time" name="week[Wednesday][end_time][]">
                </div>
            </div>
            <div class="plus_div">
                <a class="add_times"><i class="fa fa-plus"></i></a>
                <label for="">open/close </label>
                <input type="checkbox" name="week[Wednesday][opening_status]" >
            </div>
        </div>
        <div class="form-group" style="position: relative;display:flex;">
            <label for="">thursday </label>
            <div class="main_section">
                <div class="timer_div">
                    <input type="time" name="week[Thursday][start_time][]">
                    <input type="time" name="week[Thursday][end_time][]">
                </div>
            </div>
            <div class="plus_div">
                <a class="add_times"><i class="fa fa-plus"></i></a>
                <label for="">open/close </label>
                <input type="checkbox" name="week[Thursday][opening_status]" >
            </div>

        </div>
        <div class="form-group" style="position: relative;display:flex;">
            <label for="">friday </label>
            <div class="main_section">
                <div class="timer_div">
                    <input type="time" name="week[Friday][start_time][]" >
                    <input type="time" name="week[Friday][end_time][]" >
                </div>
            </div>
            <div class="plus_div">
                <a class="add_times"><i class="fa fa-plus"></i></a>
                <label for="">open/close </label>
                <input type="checkbox" name="week[Friday][opening_status]" >
            </div>
        </div>
        <div class="form-group" style="position: relative;display:flex;">
            <label for="">saturday </label>
            <div class="main_section">
                <div class="timer_div">
                    <input type="time" name="week[Saturday][start_time][]" class="start_time">
                    <input type="time" name="week[Saturday][end_time][]" class="end_time">
                </div>
            </div>
            <div class="plus_div">
                <a class="add_times"><i class="fa fa-plus"></i></a>
                <label for="">open/close </label>
                <input type="checkbox" name="week[Saturday][opening_status]" >
            </div>
        </div>
        <div class="form-group" style="position: relative;display:flex;">
            <label for="">sunday </label>
            <div class="main_section">
                <div class="timer_div">
                    <input type="time" name="week[Sunday][start_time][]" class="start_time">
                    <input type="time" name="week[Sunday][end_time][]" class="end_time">
                </div>
            </div>
            <div class="plus_div">
                <a class="add_times"><i class="fa fa-plus"></i></a>
                <label for="">open/close </label>
                <input type="checkbox" name="week[Sunday][opening_status]" >
            </div>
        </div>
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
    $(document).on("click",".add_times",function(){
        var html = `<div class="timer_div"><input type="time" name="week[Monday][start_time][]" class="">
                <input type="time" name="week[Monday][end_time][]" class=""></div>`;
        $(this).parent().parent().find(".main_section").append(html);
    })

</script>
</html>

