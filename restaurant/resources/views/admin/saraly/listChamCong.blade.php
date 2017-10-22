@extends('admin.layouts.master3')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid" style="margin-left: -59px;">
            <div class="col-lg-12" style="margin-left: 38px;">
                <h1 class="page-header">Danh sách chấm công nhân viên - Tháng {{date('m') - 1}}
                    <a href="{{route('admin.saraly.getChamCong')}}" class="btn btn-primary">+ Tạo</a>
                </h1>
                <form method="post" id="formShowChamCong" action="{{route('showDetailChamCong')}}">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <div class="form-group" style="float: left;margin-left: -13px">
                        <label style="position: absolute;margin-left: 17px;">Tháng</label>
                        <div class="col-sm-3" style="margin-top: 24px;width: 126px;">
                            <select class="form-control" name="month">
                                @if (isset($currentMonth))
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="<?=$i?>" <?php echo 'selected="selected"' ?>>
                                            <?=$i?></option>
                                    @endfor
                                    <option style="color: black;background: silver;"
                                            value="<?=$currentMonth?>" <?php echo 'selected="selected"' ?>>
                                        <?=$currentMonth?></option>
                                @else
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="<?=$i?>"><?=$i?></option>
                                    @endfor
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="float: left">
                        <label style="margin-left: -111px;">Năm</label>
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
                    <button type="submit" name="btnShowChamCong" class="btn btn-primary" style="margin-top: 24px">Xem
                    </button>
                </form>
            </div>
            <div class="panel-body">
                @if (!isset($currentMonth, $currentYear))
                    <table class="table table-striped table-bordered table-hover"
                           style="font-size: 12px;border-collapse: collapse;margin-left: 38px">
                        <caption><h3>Bảng chấm công - Tháng <?=date('m') - 1?></h3></caption>
                        <thead>
                        <tr align="center">
                            <th width="70px">Tên</th>
                            <?php
                            for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m') - 1, date('Y')); $i++)
                                echo "<th>" . $i . "</th>";
                            echo "<th>Tổng </th>";
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
                                    <?php $getChamCong = $emp->ChamCong;
                                    ?>
                                    @for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m') - 1, date('Y')); $i++)
                                        <td>
                                            <table style="height: 73px"
                                                   class="table table-striped table-bordered table-hover">
                                                <?php
                                                $str = $emp->hasChamCong(date('m') - 1, date('Y'), $i, $getChamCong);
                                                if (!empty($str)) {
                                                    echo $str;
                                                } else {
                                                    echo "<tr><td width='22px'>&nbsp;</td></tr>";
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    @endfor
                                    <td>

                                    </td>
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
                        <caption><h3>Bảng chấm công - Tháng <?=$currentMonth?></h3></caption>
                        <thead>
                        <tr align="center">
                            <th width="70px">Tên</th>
                            <?php
                            for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); $i++)
                                echo "<th>" . $i . "</th>";
                            echo "<th>Tổng </th>";
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
                                    <?php $getChamCong = $emp->ChamCong;
                                    ?>
                                    @for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); $i++)
                                        <td>
                                            <table style="height: 73px"
                                                   class="table table-striped table-bordered table-hover">
                                                <?php
                                                $str = $emp->hasChamCong( $currentMonth, $currentYear, $i, $getChamCong);
                                                if (!empty($str)) {
                                                    echo $str;
                                                } else {
                                                    echo "<tr><td width='22px'>&nbsp;</td></tr>";
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    @endfor
                                    <td>


                                    </td>
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
    <script type="text/javascript" src="{{url('admin/js/showChamCong.js')}}"></script>
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 3px;
        }

        .table {
            margin-bottom: 0;
        }
    </style>
@stop