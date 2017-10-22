@extends('admin.layouts.master3')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tạo lịch làm việc nhân viên</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include ('block.flash')
                    <form method="POST" action="{{route('admin.employer.postCalendar')}}" class="form-horizontal"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <fieldset>
                            <div class="form-group" style="float: left">
                                <label style="position: absolute;margin-left: 17px;">Tháng</label>
                                <div class="col-sm-3" style="margin-top: 24px;width: 126px;">
                                    <select class="form-control" name="month">
                                        @for($i = date('m') + 1; $i <= 12; $i++)
                                            <option value="<?=$i?>"><?=$i?></option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="position: absolute;margin-left: 17px;">Năm</label>
                                <div class="col-sm-3" style="margin-top: 24px;width: 126px;">
                                    <select class="form-control" name="year">
                                        @for ($i = date('Y'); $i <= date('Y')+1; $i++)
                                            <option value="<?=$i?>"><?=$i?></option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover" style="font-size: 12px;margin-left: -15px">
                                    <thead>
                                    <tr align="center">
                                        <th width="70px">Tên</th>
                                        <th style='width: 70px;'>Ca</th>
                                        <?php
                                        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m') + 1, date('Y')); $i++)
                                            echo "<th>" . $i . "</th>";
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employer as $emp)
                                        <tr>
                                            <td rowspan="4"><b>{{$emp->name}}</b><br>({{$emp->TypeEmployer->description}})</td>
                                            @foreach($cals as $cal)
                                            <tr>
                                                <td style="text-align: center"><b>{{$cal->name}}</b></td>
                                                @for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m') + 1, date('Y')); $i++)
                                                    <td>
                                                        <input type="checkbox" name="selectedDay[]" class="selectedDay"
                                                               value="<?=$i?>-{{$cal->id}}-{{$emp->id_employer}}">
                                                    </td>
                                                @endfor
                                            </tr>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-4 form-group" style="margin-left: 136px;">
                                <button type="button" value="create" id="submit" class="btn btn-primary"><strong>Tạo
                                        lịch</strong></button>
                                <button type="reset" value="reset" name="reset" class="btn ">Reset</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{url('admin/js/calendar.js')}}"></script>
@stop