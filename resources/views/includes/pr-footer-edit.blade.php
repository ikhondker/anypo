<tr class="">
    <td colspan="6" class="text-end">
        <strong>Subtotal:</strong>
    </td>
    <td class="text-end">
        <input type="number" step='0.01' min="1" class="form-control @error('sub_total') is-invalid @enderror" 
            style="text-align: right;"
            name="sub_total" id="sub_total" placeholder="1.00" 
            value="{{ old('sub_total',$pr->sub_total) }}"
            required readonly>
        @error('sub_total')
                <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </td>
    <td class="">
        {{-- <x-widgets.submit/> --}}
    </td>
</tr>

<tr class="">
    <td colspan="6" class="text-end">
        Tax:
    </td>
    <td class="text-end">
        <input type="number" step='0.01' min="1" class="form-control @error('tax') is-invalid @enderror" 
            style="text-align: right;"
            name="tax" id="tax" placeholder="1.00" 
            value="{{ old('tax',$pr->tax) }}"
            required>
        @error('tax')
                <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </td>
    <td class="">
        {{-- <x-widgets.submit/> --}}
    </td>
</tr>

<tr class="">
    <td colspan="6" class="text-end">
        Shipping:
    </td>
    <td class="text-end">
        <input type="number" step='0.01' min="1" class="form-control @error('shipping') is-invalid @enderror" 
            style="text-align: right;"
            name="shipping" id="shipping" placeholder="1.00" 
            value="{{ old('shipping',$pr->shipping) }}"
            required>
        @error('shipping')
                <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </td>
    <td class="">
        {{-- <x-widgets.submit/> --}}
    </td>
</tr>

<tr class="">
    <td colspan="6" class="text-end">
        Discount (-):
    </td>
    <td class="text-end">
        <input type="number" step='0.01' min="1" class="form-control @error('discount') is-invalid @enderror" 
            style="text-align: right;"
            name="discount" id="discount" placeholder="1.00" 
            value="{{ old('discount',$pr->discount) }}"
            required>
        @error('discount')
                <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </td>
    <td class="">
        {{-- <x-widgets.submit/> --}}
    </td>
</tr>

<tr class="">
    <td colspan="6" class="text-end">
        <strong>TOTAL:</strong>
    </td>
    <td class="text-end">
        <input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror" 
            style="text-align: right;"
            name="amount" id="amount" placeholder="1.00" 
            value="{{ old('amount',$pr->amount) }}"
            required readonly>
        @error('amount')
                <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </td>
    <td class="">
        {{-- <x-widgets.submit/> --}}
    </td>
</tr>


<tr class="">
    <td colspan="6" class="">
        
    </td>
    <td class="">
        <x-widgets.submit/>
    </td>
</tr>    
