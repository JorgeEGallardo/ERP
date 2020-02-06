<select id="countries" name="pais" onchange="getStates(this.value)" value="" class="form-control" placeholder="País" required>
    @foreach($countries as $country)
    <option value="{{$country->id}}">{{$country->name}}</option>
    @endforeach
</select>
