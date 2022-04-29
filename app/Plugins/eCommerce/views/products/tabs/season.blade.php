<tr class="tbody_season_tr">


    <td class="item_name">
        <input type="text" class="form-control"
               placeholder=""
               name="_rental_season_price[]"
               value="{{$season[0]['base_price'] ?? ''}}">

    </td>
    <td class="">
        <input type="text" class="PickingUpDate  form-control"
               placeholder=""
               name="_rental_season_start_date[]"
               value="{{ isset($season[0]['startDate'])  ?  date('m/d/Y',$season[0]['startDate'] ) : '' }}">
    </td>
    <td class="quantity">
        <input type="text" class="DroppingOffDate form-control"
               placeholder=""
               name="_rental_season_end_date[]"
               value="{{ isset($season[0]['endDate'])  ?  date('m/d/Y',$season[0]['endDate'] ) : '' }}">
    </td>


    <td class="quantity">
        <table class="table color-table t_season_discounts">
            <thead>
            <tr>
                <th>{{__("Cost")}}</th>
                <th>{{__("Duration")}}</th>
                <th>{{__("type")}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="season_discount">


            @if(isset($season[0]))
                @foreach($season as $k =>$v)
                    <tr class="t_season__it">

                        <td class="cost">
                            <input type="text"
                                   class=" form-control input_text cost "
                                   placeholder="Cost"
                                   name="_rental_season_discount[{{$i}}][cost][]"
                                   value="{{$v['cost'] ?? ''}}">
                        </td>
                        <td class="duration">
                   <span class="wrap">
                      <span class="col-md-6">
                           <input type="text"
                                  class="form-control input_text short duration_val"
                                  placeholder=""
                                  name="_rental_season_discount[{{$i}}][duration_val][]"
                                  value="{{$v['Duration'] ?? ''}}">

                      </span>
                      <span class="col-md-6">
                           <select class=" form-control short duration_type"
                                   name="_rental_season_discount[{{$i}}][duration_type][]">
                              <option <?php  selected($v['type'] ?? '', 'hours') ?> value="hours">{{__('Hour(s)')}}</option>
                                 <option <?php  selected($v['type'] ?? '', 'days') ?>  value="days">{{__('Day(s)')}}</option>

                           </select>
                      </span>


                  </span>
                        </td>
                        <td width="1%"><a href="#"
                                          class="delete  btn-delete">{{__("x")}}</a></td>
                    </tr>
                @endforeach
                @else
                <tr class="t_season__it">
                    <td class="cost">
                        <input type="text"
                               class=" form-control input_text cost "
                               placeholder="Cost"
                               name="_rental_season_discount[0][cost][]"
                               value="">
                    </td>
                    <td class="duration">
                   <span class="wrap">
                      <span class="col-md-6">
                           <input type="text"
                                  class="form-control input_text short duration_val"
                                  placeholder=""
                                  name="_rental_season_discount[0][duration_val][]"
                                  value="">

                      </span>
                      <span class="col-md-6">
                           <select class=" form-control short duration_type"
                                   name="_rental_season_discount[0][duration_type][]">
                                  <option value="hours">{{__('Hour(s)')}}</option>
                                 <option value="days">{{__('Day(s)')}}</option>

                           </select>
                      </span>


                  </span>
                    </td>
                    <td width="1%"><a href="#"
                                      class="delete  btn-delete">{{__("x")}}</a></td>
                </tr>
            @endif



            </tbody>
            <tfoot>
            <tr>
                <th colspan="6">
                    <button type="button"
                            class="btn btn-info waves-effect waves-light  insert_season_discounts"
                            data-row="{{$seasonDiscount }}">{{__('Add discounts')}}
                    </button>
                </th>
            </tr>
            </tfoot>
        </table>
    </td>
    <td width="1%">
        <button data-toggle="tooltip"
                data-original-title="Delete"
                class="btn btn-danger btn-delete"
                type="button">
            <span class="glyphicon glyphicon-minus"></span>
        </button>

    </td>

</tr>