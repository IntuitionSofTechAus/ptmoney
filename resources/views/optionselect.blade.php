@foreach($data as $row)
<option value="{{$row->id}}" @if($row->id == $state){{'selected'}}@endif>{{$row->name}}</option>
@endforeach