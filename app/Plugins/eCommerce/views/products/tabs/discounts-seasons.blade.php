<tr class="t_season__it">
    <td class="cost">
        <input type="text"
               class="form-control input_text cost "
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
                           <select class="form-control short duration_type"
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