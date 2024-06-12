<tr>
    <th>Cell X:</th>
    <td>
        <input type="text" class="form-control @error('cell') is-invalid @enderror"
        name="cell" id="cell" placeholder="+1"
        value="{{ old('cell', $value ) }}"
        required/>
        @error('cell')
            <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </td>
</tr>
