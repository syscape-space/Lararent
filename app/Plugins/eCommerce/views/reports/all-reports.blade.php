<div class="container-fluid">
    <!-- row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box calendar-widget">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

	<?php  //dump( $bookings[0]->product ); ?>
    <script>
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var calendar = $('#calendar').fullCalendar({
            /*
                header option will define our calendar header.
                left define what will be at left position in calendar
                center define what will be at center position in calendar
                right define what will be at right position in calendar
            */
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            firstDay: 1,
            //handleWindowResize: true,
            fixedWeekCount: false,
            /*
                editable: true allow user to edit events.
            */
            // editable: true,
            /*
                events is the main option for calendar.
                for demo we have added predefined events in json object.
            */
            events: [

                    @foreach ($bookings as $booking)


                {
                    title: '{{$booking->product->title ?? ''}}',
                    start: '{{ date('c', $booking->PickingUpDate  ?? '')}}',
                    end: '{{ date('c', $booking->DroppingOffDate  ?? '')}}',
                    color: '#ff9f89',
                    textColor: '#ffffff',
                    url: '{{route('admin.products.edit',['product'=>$booking->product->id  ?? ''])}}'
                },

                    @endforeach

               /* {
                    title: 'Event red',
                    start: '2019-02-06',
                    end: '2019-02-20',

                    color: '#ff9f89'
                }*/

            ],
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url);
                    return false;
                }
            },
            eventColor: 'transparent'
        });
    </script>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">{{__('Orders Chart')}}</h3>
                <ul class="list-inline text-right">
                    <li>
                        <h5><i class="fa fa-circle text-info m-r-5"></i>{{__('All orders')}}</h5></li>
                    <li>
                        <h5><i class="fa fa-circle text-warning m-r-5"></i>{{__('Completed orders')}}</h5></li>
                    <li>
                        <h5><i class="fa fa-circle text-purple m-r-5"></i>{{__('Pending orders')}}</h5></li>
                    <li>
                        <h5><i class="fa fa-circle text-primary m-r-5"></i>{{__('Paid orders')}}</h5></li>
                    <li>
                        <h5><i class="fa fa-circle text-danger m-r-5"></i>{{__('Canceled orders')}}</h5></li>
                </ul>
                <div id="morris-order-status"></div>


            </div>
        </div>

    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">{{__('Total Sales ')}} <span class="pull-right">
                        {{ formatted_price( $totalSales) }}
                    </span></h3>
                <div id="morris-line-chart"></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">{{__('Registered users')}}</h3>
                <div id="morris-bar-chart"></div>
            </div>
        </div>

    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row">

    </div>
    <!-- /.row -->
    <!-- .row -->

</div>


<script>
    $(function () {

        "use strict";

        // Dashboard 1 Morris-chart


        Morris.Area({
            element: 'morris-order-status',
            data: [
					<?php
					if ( isset( $orders_all ) ) {
					// years
					foreach ( $orders_all as $k => $v ) {

					// month
					foreach ( $v as $key => $val ) {
					?>
                {
                    period: '{{$k}}-{{$key}}',
                    all: {{$val['count']}},
                    completed:  {{$val['completed']}},
                    pending:  {{$val['pending']}},
                    paid:  {{$val['paid']}},
                    canceled:  {{$val['canceled']}},
                },
				<?php
				}
				}
				}

				?>


            ],
            xkey: 'period',
            ykeys: ['all', 'completed', 'pending', 'paid', 'canceled'],
            labels: ['All orders', 'Completed orders', 'Pending orders', 'Paid orders', 'Canceled orders'],
            pointSize: 3,
            fillOpacity: 0,
            pointStrokeColors: ['#00bbd9', '#ffb136', '#4a23ad', '#0283cc', '#e74a25'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#00bbd9', '#ffb136', '#4a23ad', '#0283cc', '#e74a25'],
            resize: true

        });

        // Morris bar chart
        Morris.Bar({
            element: 'morris-line-chart',
            data: [
			        <?php
			        if(isset( $TotalSalesPerMoth )){
			        foreach ($TotalSalesPerMoth as $k=>$v){
			        ?>
                {
                    y: '{{$v->SalesYear}}-{{$v->SalesMonth}}',
                        a: '{{ ($v->TotalSales)}}'
                },
		        <?php
		        }
		        }
		        ?>

            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['registered users'],
            barColors: ['#2ecc71'],
            hideHover: 'auto',
            gridLineColor: '#e0e0e0',
            resize: true
        });

        Morris.Bar({
            element: 'morris-bar-chart',
            data: [
					<?php
					if(isset( $users )){
					foreach ($users as $k=>$v){

					?>
                {
                    y: '{{$v->Year}}-{{$v->Month}}',
                    a: {{$v->TotalUsers}}
                },
				<?php
				}
				}
				?>

            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['registered users'],
            barColors: ['#2ecc71'],
            hideHover: 'auto',
            gridLineColor: '#e0e0e0',
            resize: true
        });
        // Extra chart

    });

</script>