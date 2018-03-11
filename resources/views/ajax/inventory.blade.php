<option disabled>-Inventories-</option>
@foreach($inventory as $data)
<option value="{{ $data->inventory_id }}">{{$data->name}}</option>
@endforeach