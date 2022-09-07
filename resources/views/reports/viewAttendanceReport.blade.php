@extends('layouts.master')
@section('title')
    Date Wise Sales
@endsection
@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <p>Date Wise Attendance Report</p>
            </div>
            <!--begin::Card title-->

        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="row">
                <form action="" method="get">
                    <div class="form-group row mb-4">
                        <div class="col-lg-6">
                            <label class="form-label required">Choose Date Range</label>
                            <input class="form-control form-control-solid" placeholder="" id="kt_daterangepicker_4"
                                name="date" />
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label required">User</label>
                            <select class="form-select form-select-solid " data-control='select2'namedata-allow-clear="true"
                                id="user_id" name="status">
                                <option value="ALL">All</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                                {{-- <option value="CANCELED">Cancelled</option> --}}
                            </select>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" onclick="getAttendanceData();">View</button>
                    </div>

                </form>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <script type="text/javascript">
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_daterangepicker_4").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            }
        }, cb);

        cb(start, end);

        function getAttendanceData() {
            var date = $('#kt_daterangepicker_4').val();
            var user_id = $('#user_id').val();
            $.ajax({
                type: 'get',
                url: '{{ route('getReportData') }}',
                data:{
                    date:date,
                    user_id: user_id
                },
                success: function(data) {
                    console.log(data);
                }
            })
        }
    </script>



    <!-- begin::modal -delete User !-->

    <!--End Modal !-->
@endsection
