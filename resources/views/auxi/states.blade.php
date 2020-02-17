<select id="states" name="estado" onchange="getCities(this.value)" class="form-control" placeholder="Estado" required>
    @foreach($states as $state)
    <option @if($state->name == 'Durango') selected="selected" @endif value="{{$state->name}}">{{$state->name}}</option>
    @endforeach
</select>
