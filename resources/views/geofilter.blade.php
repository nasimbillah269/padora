<option value="">Select City</option>
@foreach($datas as $data)
<option value="{{$data->id}}">{{$data->name}}</option>
@endforeach