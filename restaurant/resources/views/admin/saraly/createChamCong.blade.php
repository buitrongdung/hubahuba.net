@extends('admin.layouts.master3')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chấm công nhân viên - Tháng {{date('m')-1}} - {{date('Y')}}</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include ('block.flash')
                    @include('block.error')
                    <form method="POST" action="{{route('admin.saraly.ChamCong')}}" class="form-horizontal"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <table class="table table-striped table-bordered table-hover" style="margin-left: -28px">
                            <thead>
                            <tr align="center">
                                <th>Mã</th>
                                <th style="width: 0px;">Tên NV</th>
                                @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m')-1, date('Y')); $i++)
                                    <th style="width: 33px"><?=$i?></th>
                                @endfor
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employer as $emp)
                                <tr id="show" class="odd gradeX" align="center">
                                    <td>{{$emp->id_employer}}</td>
                                    <td style="width: 121px">{{$emp->name}}</td>
                                    @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m')-1, date('Y')); $i++)
                                        <td style="width: 33px">
                                            <input type="checkbox" name="selectedDay[]" class="selectedDay" value="<?=$i?>-{{$emp->id_employer}}">
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-4 form-group" style="margin-left: 128px;">
                            <button type="submit" id="submit" class="btn btn-primary">
                                <strong>Tạo</strong></button>
                            <button type="reset" value="reset" name="reset" class="btn">Reset</button>
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ url('admin/js/chamCong.js')  }}"></script>
@stop