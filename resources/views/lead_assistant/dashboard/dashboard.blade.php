@extends('layouts.lead_assistant')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<section class="admin-content">
    <div class="container p-t-20">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            <i class="mdi mdi-checkbox-intermediate"></i> Today's Appointment
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slot</th>
                                    <th>Address</th>
                                    <th>Area</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($getTotalLead) > 0)
                                    @foreach($getTotalLead as $tk => $tv)
                                        <tr>
                                            <td>{{ $tv->user->first_name }} {{ $tv->user->last_name }}</td>
                                            @if(in_array($tv->time_slot_id,$slot))
                                                <td>{{ $slot[$tv->time_slot_id] }}</td>
                                            @else
                                                <td>------------</td>
                                            @endif
                                            <td>{{ $tv->user->address1 }}</td>
                                            <td>{{ $tv->user->address2 }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"><center>No Appointment Schedule Today</center></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 my-auto">
                                <h2>Conversion Rate </h2>
                                <p class="text-muted">
                                    Converted out of All Leads
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <div style="overflow: hidden;max-height: 210px!important">
                                    <div id="chart-07"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>

        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    if($("#chart-07").length){


        var options = {
            // colors:colors[18],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: 0,
                            fontSize: '22px'
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            series: ,

        }

        var chart = new ApexCharts(
            document.querySelector("#chart-07"),
            options
        );

        chart.render();

    }
</script>
@endsection