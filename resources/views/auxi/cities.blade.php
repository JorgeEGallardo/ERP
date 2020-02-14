<select id="cities" name="ciudad" value="{{ old('ciudad') }}" class="form-control" placeholder="ciudad" required>
    @foreach($cities as $city)
    <option  value="{{$city->id}}" @if($city->name == 'Durango') selected="selected" @endif >{{$city->name}}</option>
    @endforeach
</select>
