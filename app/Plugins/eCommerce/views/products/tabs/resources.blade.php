<tr>

    <td class="item_name" width="40%">
        <input type="text" class="form-control"
               placeholder="Item name"
               name="_rental_resource_[item_name][]" value="{{ $name ?? '' }}">
    </td>
    <td class="quantity" width="11%">
        <input type="text" class="form-control"
               placeholder="Qty"
               name="_rental_resource_[quantity][]" value="{{ $resources->quantity[$j ?? ''] ?? ''}}">
    </td>
    <td class="cost" width="11%">
        <input type="text" class="form-control"
               placeholder="Cost"
               name="_rental_resource_[cost][]" value="{{ $resources->cost[$j ?? ''] ?? ''}}">
    </td>
    <td class="duration" width="26%">
        <span class="wrap">

            <select class="form-control" name="_rental_resource_[duration_type][]">
                <option <?php  selected($resources->duration_type[$j ?? ''] ??  '', 'hours' ); ?> value="hours">{{__('Hour(s)')}}</option>
                <option <?php  selected($resources->duration_type[$j ?? ''] ??  '', 'days' ); ?> value="days" selected="selected">{{__('Day(s)')}}</option>
                <option <?php  selected($resources->duration_type[$j ?? ''] ??  '', 'total' ); ?> value="total">{{__("Total")}}</option>
                <option <?php  selected($resources->duration_type[$j ?? ''] ??  '', 'Included' ); ?> value="Included">{{__("Included")}}</option>
                <option <?php  selected($resources->duration_type[$j ?? ''] ??  '', 'fixed_change' ); ?> value="fixed_change">{{__("Fixed charge")}}</option>


            </select>
        </span>
    </td>

    <td width="1%">
        <button data-toggle="tooltip"
                data-original-title="Delete" class="btn btn-danger btn-delete" type="button">
            <span class="glyphicon glyphicon-minus"></span>
        </button>

    </td>

</tr>
