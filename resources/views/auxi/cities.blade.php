<select  id="cities" name="ciudad"  value="{{ old('ciudad') }}" class="form-control" placeholder="ciudad" required>
    @foreach($cities as $city)
    <option value="{{$city->id}}">{{$city->name}}</option>
    @endforeach
    </select>
