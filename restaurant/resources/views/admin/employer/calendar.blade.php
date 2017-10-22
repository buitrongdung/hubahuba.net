@extends('admin.layouts.master3')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid" style="margin-left: -59px;">
            <div class="col-lg-12" style="margin-left: 38px;">
                <h1 class="page-header">Lịch làm việc
                    <a href="{{route('admin.employer.getCalendar')}}" class="btn btn-primary">+ Tạo lịch làm việc</a>
                </h1>
                <table style="margin-left: 37px;margin-bottom: 10px">
                    <tr>
                        Thời gian làm việc:
                    </tr>
                    <?php
                    $data = DB::table('ca_lam_viec')->select('name', 'time')->get();
                    ?>
                    @foreach ($data as $item)
                        <tr>
                            <th>{!! $item->name !!}:&nbsp;</th>
                            <td> {!! $item->time !!} </td>
                        </tr>
                    @endforeach
                </table>
                <form method="post" action="{{ route('showCalendar') }}" id="formShowCalendar">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group" style="float: left">
                        <label style="position: absolute;margin-left: 17px;">Tháng</label>
                        <div class="col-sm-3" style="margin-top: 24px;width: 126px;">
                            <select class="form-control" name="month">
                                @if (isset($currentMonth))
                                    @for($i = date('m') + 0; $i <= 12; $i++)
                                        <option value="<?=$i?>" <?php echo 'selected="selected"' ?>>
                                            <?=$i?></option>
                                    @endfor
                                    <option style="color: black;background: silver;"
                                            value="<?=$currentMonth?>" <?php echo 'selected="selected"' ?>>
                                        <?=$currentMonth?></option>
                                @else

                                    @for($i = date('m') + 0; $i <= 12; $i++)
                                        <option value="<?=$i?>"><?=$i?></option>
                                    @endfor
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="position: absolute;margin-left: 17px;">Năm</label>
                        <div class="col-sm-3" style="margin-top: 24px;width: 126px;">
                            <select class="form-control" name="year">
                                @if (isset($currentYear))
                                    @for($i = date('Y'); $i <= date('Y')+1; $i++)
                                        <option value="<?=$i?>" <?php echo 'selected="selected"' ?>>
                                            <?=$i?></option>
                                    @endfor
                                    <option style="color: black;background: silver;"
                                            value="<?=$currentYear?>" <?php echo 'selected="selected"' ?>>
                                        <?=$currentYear?></option>
                                @else

                                    @for ($i = date('Y'); $i <= date('Y')+1; $i++)
                                        <option value="<?=$i?>"><?=$i?></option>
                                    @endfor
                                @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 24px">Xem
                    </button>
                </form>
            </div>
            <div class="panel-body">
                @if (!isset($currentMonth, $currentYear))
                    <table class="table table-striped table-bordered table-hover"
                           style="font-size: 12px;border-collapse: collapse;margin-left: 38px">
                        <caption><h3>Lịch làm việc tháng <?=date('m') + 0?></h3></caption>
                        <thead>

                        <tr align="center">
                            <th width="70px">Tên</th>
                            <th style='width: 70px;'>Ca</th>
                            <?php
                            for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); $i++)
                                echo "<th>" . $i . "</th>";
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        @if (isset($employee))
                            @foreach($employee as $emp)
                                <tr id="showCalendar">
                                    <td style="font-size: 13px;text-align: center;">
                                        <b>{{$emp->name}}</b><br>({{$emp->TypeEmployer->description}})
                                    </td>
                                    <td>
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td style="text-align: center;"><b> 1</b></td>
                                            <tr>
                                                <td style="text-align: center;"><b> 2</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;"><b> 3</b></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php $getCalendar = $emp->Calendar;
                                    $month = date('m');
                                    ?>

                                    @for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, date('Y')); $i++)

                                        <td>
                                            <table style="height: 73px"
                                                   class="table table-striped table-bordered table-hover">
                                                @for($j = 1; $j <= 3; $j++)
                                                    <?php
                                                    $str = $emp->hasDate($month, date('Y'), $i, $j, $getCalendar);
                                                    if (!empty($str)) {
                                                        echo $str;
                                                    } else {
                                                        echo "<tr><td>&nbsp;</td></tr>";
                                                    }
                                                    ?>
                                                @endfor
                                            </table>
                                        </td>

                                    @endfor

                                </tr>
                            @endforeach
                        @else
                            <h2 style="color: red">Không có tháng này</h2>
                        @endif
                        </tbody>
                    </table>
                @else
                    <table class="table table-striped table-bordered table-hover"
                           style="font-size: 12px;border-collapse: collapse;margin-left: 38px">
                        <caption><h3>Lịch làm việc tháng <?=$currentMonth?></h3></caption>
                        <thead>

                        <tr align="center">
                            <th width="70px">Tên</th>
                            <th style='width: 70px;'>Ca</th>
                            <?php
                            for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); $i++)
                                echo "<th>" . $i . "</th>";
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        @if (isset($employee))
                            @foreach($employee as $emp)
                                <tr id="showCalendar">
                                    <td style="font-size: 13px;text-align: center;">
                                        <b>{{$emp->name}}</b><br>({{$emp->TypeEmployer->description}})
                                    </td>
                                    <td>
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td style="text-align: center;"><b> 1</b></td>
                                            <tr>
                                                <td style="text-align: center;"><b> 2</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;"><b> 3</b></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php $getCalendar = $emp->Calendar;
                                    ?>

                                    @for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); $i++)

                                        <td>
                                            <table style="height: 73px"
                                                   class="table table-striped table-bordered table-hover">
                                                @for($j = 1; $j <= 3; $j++)
                                                    <?php
                                                    $str = $emp->hasDate($currentMonth, $currentYear, $i, $j, $getCalendar);
                                                    if (!empty($str)) {
                                                        echo $str;
                                                    } else {
                                                        echo "<tr><td>&nbsp;</td></tr>";
                                                    }
                                                    ?>
                                                @endfor
                                            </table>
                                        </td>

                                    @endfor

                                </tr>
                            @endforeach
                        @else
                            <h2 style="color: red">Không có tháng này</h2>
                        @endif
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{url('admin/js/calendar.js')}}"></script>
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 3px;
        }

        .table {
            margin-bottom: 0;
        }
    </style>
@stop