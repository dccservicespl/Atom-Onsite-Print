@extends('layouts.main')
@section('content')
<style>
    .printer-card {
        cursor: pointer;
        border: 1px solid #ddd;
    }

    .printer-card.selected {
        background-color: #e0f7fa;
        border-color: #00796b;
    }

    .location {
        font-size: 18px;
        cursor: pointer;
    }

    .printer {
        font-size: 14px;
        cursor: pointer;
    }

    .form-check {
        cursor: pointer;
    }

    .printer-radio,
    .bi-printer,
    .form-check-label {
        cursor: pointer;
    }
</style>
<div class="row g-0 mt-3">
    <div class="col-lg-12 col-xl-12 ps-lg-2 mb-3">
        <div class="card h-100">
            <div class="card-body pb-5 pt-5">
                <div class="row">
                    <div class="col-md-3">
                        <input type="date" name="rec_date_time" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <select name="print_by_id" id="" class="form-control">
                            <option value="">Select a User</option>
                            @foreach (json_decode(get_users(), true)['data'] as $get_user_data)
                            <option value="{{ $get_user_data['id'] }}"> {{ $get_user_data['name'] }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="printer_status" id="" class="form-control">
                            <option value="">Select a Status</option>
                            <option value="1">Success</option>
                            <option value="0">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-primary form-control" id="printer_filter_submit" type="submit"><i class="bi bi-funnel"></i> Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-0 mt-3">
    <div class="col-lg-12 col-xl-12 ps-lg-2 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                <h5 class="mb-0">All Pending Prints</h5>
                <a class="py-1 fs-10 font-sans-serif btn btn-outline-primary" href="#!">View All</a>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive scrollbar">
                    <table class="table table-hover table-striped overflow-hidden">
                        <thead style="background: #065fb8;">
                            <tr>
                                <th scope="col" class="text-white">Date</th>
                                <th scope="col" class="text-white">Print Queue</th>
                                <th scope="col" class="text-white">No. Of Page</th>
                                <th scope="col" class="text-white">Print Request</th>
                                <th scope="col" class="text-white">Status</th>
                                <th class="text-end text-white" scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody id="printer_filter_data">
                            @if ($get_all_print_queues)
                            @foreach ($get_all_print_queues as $get_all_print_queues_data)
                                <tr class="align-middle">
                                    <td class="text-nowrap">{{ date('m-d-Y', strtotime($get_all_print_queues_data['rec_date_time'])) }}</td>
                                    <td class="text-nowrap">{{ Str::title($get_all_print_queues_data['print_file']);  }}</td>
                                    <td class="text-nowrap">{{ $get_all_print_queues_data['page_no'] }}</td>
                                    <td class="text-nowrap">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">{!! json_decode(get_users($get_all_print_queues_data['print_by_id']), true)['data'][0]['name'] !!}</div>
                                        </div>
                                    </td>
                                    <td>
                                        {!! generateStatusCode($get_all_print_queues_data['print_status']) !!}
                                    </td>
                                    <td class="text-end">
                                        <a class="btn btn-tertiary border-300 btn-sm me-1 text-600 text-end"
                                            data-bs-placement="top" title="Print Now"
                                            download="Print Now" data-bs-toggle="modal" data-bs-target="#printerModal">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr class="align-middle">
                                <td class="text-nowrap" colspan="6">
                                    <p class="text-center text-danger h5 p-5"> No Data Found! </p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center w-100 p-5 loader_spinner" style="display: none;">
                        <div class="spinner-border text-center text-primary" role="status">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-lg" id="printerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Default Printer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($get_all_printers as $key => $printer)
                    <div class="col-md-4">
                        <div class="card p-3 mb-3 printer-card"
                            data-key="{{ $key }}" data-printer-id="{{ $printer['printer_ip'] }}">
                            <div class="form-check">
                                <i class="bi bi-printer"></i>
                                <label class="form-check-label" for="printer{{ $key }}">
                                    <input type="hidden" id="{{ $printer['printer_ip'] }}" name="default_printer_id">
                                    <span class="location">{{ $printer['location'] }}</span><br>
                                    <span class="printer">{{ $printer['printer_ip'] }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> <i class="bi bi-printer mr-2 h5 text-white"></i> Print</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#printer_filter_submit').on('click', function(event) {
            event.preventDefault();
            $('#printer_filter_data').hide();
            $('.loader_spinner').show();
            var rec_date_time = $('input[name=rec_date_time]').val();
            var print_by_id = $('select[name=print_by_id]').val();
            var printer_status = $('select[name=printer_status]').val();
            $.ajax({
                url: '/printer_filter_section',
                type: 'GET',
                data: {
                    rec_date_time: rec_date_time,
                    print_by_id: print_by_id,
                    printer_status: printer_status,
                },
                success: function(response) {
                    $("#printer_filter_data").html(response.data);
                    $('#printer_filter_data').show();
                    $('.loader_spinner').hide();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('.printer-card').on('click', function() {
            var printerId = $(this).data('printer-id');
            $('.printer-card').removeClass('selected');
            $(this).addClass('selected');
            $('input[name="default_printer_id"]').val(printerId);

            $('#printerModal').on('hide.bs.modal', function() {
                $('.printer-card').removeClass('selected');
                $('input[name="default_printer_id"]').val('');
            });
        });

    });
</script>
@endsection
@endsection
