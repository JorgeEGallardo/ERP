<select  id="states" name="estado" onchange="getCities(this.value)" value="{{ old('estado') }}" class="form-control" placeholder="Estado" required>
    @foreach($states as $state)
    <option value="{{$state->id}}">{{$state->name}}</option>
    @endforeach
    </select>