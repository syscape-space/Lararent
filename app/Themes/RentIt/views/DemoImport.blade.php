
<div style="padding:20px;background-color:white;

        margin-bottom: 2px;
margin-left: 15px;
margin-right: 15px;
margin-top: 5px;
        ">
    @if (session('status'))
        <div class="row">
            <div class="col-md-12">


                <div class=" alert alert-success">{{ session('status') }}</div>


            </div>
        </div>


    @endif

    Press the button for import

    <form action="" method="post">
        @csrf
        <span style="color: red; font-weight: bold"> All exist data will be deleted!</span><br><table border="0" width="600">
            <input type="hidden" name="wfm_hidenn" value="wmf_hiden">
            <tbody>
            <tr>




            </tr>
            <tr>
                <td colspan="2">
                    <p class="submit"><input type="submit" name="submit" id="submit" class=" btn btn-primary button button-primary" value="Import"></p>                    </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>