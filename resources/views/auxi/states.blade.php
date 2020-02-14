<select id="states" name="estado" onchange="getCities(this.value)" value="{{ old('estado') }}" class="form-control" placeholder="Estado" required>
    @foreach($states as $state)
    <option @if($state->name == 'Durango') selected="selected" @endif value="{{$state->id}}">{{$state->name}}</option>
    @endforeach
</select>
