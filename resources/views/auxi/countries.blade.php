<select id="countries" name="pais" onchange="getStates(this.value)" class="form-control" placeholder="País" required>
    @foreach($countries as $country)
    <option value="{{$country->name}}">{{$country->name}}</option>
    @endforeach
</select>
