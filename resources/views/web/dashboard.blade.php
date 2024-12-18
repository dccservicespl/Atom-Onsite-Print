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
    <!-- Loader Element (Initially Hidden) -->
    <div id="page-loader" class="d-none"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.7); z-index: 9999;">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="spinner-border text-primary" role="status">
            </div>
        </div>
    </div>

    <div class="row g-0 mt-3">
        <div id="flash-message-area">
            {!! flashMessage() !!}
        </div>
        <div class="col-lg-12 col-xl-12 ps-lg-2 mb-3">
            <div class="card h-100">
                <div class="card-header bg-body-tertiary py-2 text-end">
                    <a class="py-1 fs-10 font-sans-serif btn btn-outline-primary" href="/"> <i class="bi bi bi-arrow-clockwise"></i> Reset</a>
                </div>
                <div class="card-body pb-5 pt-5">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Date</label>
                            <input type="date" name="rec_date_time" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Print Request By</label>
                            <select name="print_by_id" id="" class="form-control">
                                <option value="">Select a User</option>
                                @foreach (json_decode(get_users(), true)['data'] as $get_user_data)
                                    <option value="{{ $get_user_data['id'] }}"> {{ $get_user_data['name'] }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Status</label>
                            <select name="printer_status" id="" class="form-control">
                                <option value="">Select a Status</option>
                                <option value="1">Success</option>
                                <option value="0">Pending</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-outline-primary form-control" id="printer_filter_submit"
                                type="submit"><i class="bi bi-funnel"></i> Filter</button>
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
                    <h5 class="mb-0">Printer Queues</h5>
                    <div class="ms-auto">
                        <!-- <a class="py-1 fs-10 font-sans-serif btn btn-outline-danger d-none" id="delete_selected"> <i class="bi bi bi-trash"></i> Delete</a>                 -->
                        <a class="py-1 fs-10 font-sans-serif btn btn-outline-primary" href="/"> <i class="bi bi bi-arrow-clockwise"></i> Reload</a>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="table-responsive scrollbar">
                        <table class="table table-hover table-striped overflow-hidden">
                            <thead style="background: #065fb8;">
                                <tr>
                                    <!-- <th scope="col" class="text-white">
                                        <input type="checkbox" id="select_all">
                                    </th> -->
                                    <th scope="col" class="text-white">Date</th>
                                    <th scope="col" class="text-white">Print Queue</th>
                                    <th scope="col" class="text-white">No. Of Page</th>
                                    <th scope="col" class="text-white">Print Request By</th>
                                    <th scope="col" class="text-white">Status</th>
                                    <th class="text-end text-white" scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody id="printer_filter_data">
                                @if ($get_all_print_queues->isNotEmpty())
                                    @foreach ($get_all_print_queues as $get_all_print_queues_data)
                                        <tr class="align-middle">
                                            <!-- <td class="text-nowrap">
                                                <input type="checkbox" class="row-checkbox" value="{{ $get_all_print_queues_data['id'] }}">
                                            </td> -->
                                            <td class="text-nowrap">
                                                {{ date('m-d-Y', strtotime($get_all_print_queues_data->rec_date_time)) }}
                                            </td>
                                            <td class="text-nowrap">
                                                {{ Str::title($get_all_print_queues_data->print_file) }}</td>
                                            <td class="text-nowrap">{{ $get_all_print_queues_data->page_no }}</td>
                                            <td class="text-nowrap">
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2">{!! json_decode(get_users($get_all_print_queues_data->print_by_id), true)['data'][0]['name'] !!}</div>
                                                </div>
                                            </td>
                                            <td>
                                                {!! generateStatusCode($get_all_print_queues_data->print_status) !!}
                                            </td>
                                            <td class="text-end">
                                                <a class="btn btn-tertiary border-primary  btn-sm me-1 text-600 text-end"
                                                    data-bs-placement="top" title="Print Now" download="Print Now"
                                                    id="printModal"
                                                    data-printer-queues-id="{{ $get_all_print_queues_data['id'] }}"
                                                    data-box-no="{{ $get_all_print_queues_data['page_no'] }}"
                                                    data-printer-id="{{ $get_all_print_queues_data['printer_ip_id'] }}"
                                                    data-store-id="{{ $get_all_print_queues_data['store_id'] }}"
                                                    data-name="{{ $get_all_print_queues_data['print_file'] }}"
                                                    data-header-id="{{ $get_all_print_queues_data['order_header_id'] }}"
                                                    data-bs-toggle="modal" data-bs-target="#printerModal">
                                                    <i class="bi bi-printer text-primary"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="align-middle">
                                        <td class="text-nowrap" colspan="7">
                                            <p class="text-center text-danger h5 p-5"> No data found </p>
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
    <div class="modal fade modal-lg" id="printerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Set Default Printer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($get_all_printers as $key => $printer)
                            <div class="col-md-4">
                                <div class="card p-3 mb-3 printer-card" data-key="{{ $key }}"
                                    data-printer-id="{{ $printer['printer_ip'] }}">
                                    <div class="form-check">
                                        <i class="bi bi-printer"></i>
                                        <label class="form-check-label" for="printer{{ $key }}">
                                            <input type="hidden" id="{{ $printer['printer_ip'] }}"
                                                name="default_printer_id">
                                            <span class="location">{{ $printer['location'] }}</span><br>
                                            <span class="printer" data-port="{{ $printer['port'] }}"
                                                data-printer-ip="{{ $printer['printer_ip'] }}">{{ $printer['printer_ip'] }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="printButton" data-bs-dismiss="modal"> <i
                            class="bi bi-printer mr-2 h5 text-white"></i> Print</button>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        $(document).ready(function() {
            var selectedPrinterPort;

            $(document).on('click', '.printer-card', function() {
                selectedPrinterPort = $(this).find('.printer').data('port');
                selectedPrinterIp = $(this).find('.printer').data('printer-ip');
                // alert(selectedPrinterIp);
                $('#printButton').attr('data-port', selectedPrinterPort);
                $('#printButton').attr('data-printer-ip', selectedPrinterIp);

            });

            $(document).on('click', '#printModal', function() {
                var printFile = $(this).data('name');
                var header_id = $(this).data('header-id');
                var store_id = $(this).data('store-id');
                var printer_id = $(this).data('printer-id');
                var box_no = $(this).data('box-no');
                var printer_queues_id = $(this).data('printer-queues-id');

                $('#printButton').data('name', printFile);
                $('#printButton').data('header-id', header_id);
                $('#printButton').data('store-id', store_id);
                $('#printButton').data('printer-id', printer_id);
                $('#printButton').data('box-no', box_no);
                $('#printButton').data('printer-queues-id', printer_queues_id);

            });

            $('#printButton').on('click', function() {
                var printFile = $(this).data('name');
                var header_id = $(this).data('header-id');
                var store_id = $(this).data('store-id');
                var printer_id = $(this).data('printer-id');
                var port = $(this).data('port');
                var printer_ip = $(this).data('printer-ip');
                var box_no = $(this).data('box-no');
                var printer_queues_id = $(this).data('printer-queues-id');

                if (printFile === 'Store Number Label') {
                    $('#page-loader').removeClass('d-none');
                    $.ajax({
                        url: "{{ route('store_number_label') }}",
                        data: {
                            header_id: header_id,
                            port: port,
                            printer_queues_id: printer_queues_id,
                            printer_ip: printer_ip
                        },
                        success: function(res) {
                            $('#flash-message-area').load(window.location.href +" #flash-message-area");
                            $('#flash-message-area').show();
                            $('#page-loader').addClass('d-none');
                        }
                    });
                } else if (printFile === 'Final Store Label') {
                    $('#page-loader').removeClass('d-none');
                    $.ajax({
                        url: "{{ route('final_store_label') }}",
                        data: {
                            printer_id: printer_id,
                            port: port,
                            box_no: box_no,
                            store_id: store_id,
                            header_id: header_id,
                            printer_queues_id: printer_queues_id,
                            printer_ip: printer_ip
                        },
                        success: function(res) {
                            if (res.success) {
                                $('#flash-message-area').load(window.location.href +
                                    " #flash-message-area");
                            } else if (res.error) {
                                $('#flash-message-area').load(window.location.href +
                                    " #flash-message-area");
                            }
                            $('#page-loader').addClass('d-none');
                        }
                    });
                } else {
                    console.log('No valid print queue selected');
                }
            });

            $('#printerModal').on('hidden.bs.modal', function() {
                $('#printButton').removeData('name');
            });
        });
    </script>
    <script>
        function generateStatusCode(status) {
            let output = '';
            if (status === 0) {
                output = '<span class="badge badge rounded-pill d-block p-2 badge-subtle-danger">Pending</span>';
            } else if (status === 1) {
                output = '<span class="badge badge rounded-pill d-block p-2 badge-subtle-success">Success</span>';
            } else {
                output = '<span class="badge badge rounded-pill d-block p-2 badge-subtle-secondary">On Hold</span>';
            }
            return output;
        }

        function generateUserIdPassword() {
            return JSON.stringify({
                user_id: 'admindcc@yopmail.com',
                password: '12345678'
            });
        }

        let userCache = {};

        // Function to fetch user data based on user ID
        function getUserName(userId) {
            return new Promise((resolve, reject) => {
                if (userCache[userId]) {
                    resolve(userCache[userId]);
                } else {
                    $.ajax({
                        url: `{{ env('API_URL') }}/api/get_all_users?user_id=${userId}`,
                        type: 'POST',
                        data: generateUserIdPassword(),
                        contentType: 'application/json',
                        success: function(response) {
                            const userName = response.data[0].name;
                            userCache[userId] = userName;
                            resolve(userName);
                        },
                        error: function(error) {
                            console.error("Error fetching user data:", error);
                            resolve("Unknown User");
                        }
                    });
                }
            });
        }

        // Function to fetch printer queue data
        function fetchPrinterQueueData() {
            let recDateTime = "";
            let printById = "";
            let printStatus = "";

            $.ajax({
                url: "{{ route('printer_queue_api_check') }}",
                data: {
                    recDateTime:recDateTime,
                    printById:printById,
                    printStatus:printStatus
                },
                success: function(response) {
                    console.log(response);
                    // location.reload();
                },
                error: function(error) {
                    console.error("Error fetching printer queue data:", error);
                }
            });
        }

        fetchInterval = setInterval(fetchPrinterQueueData, 5000);
        fetchPrinterQueueData();

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

    //Delete printer queues data locally
    $(document).ready(function () {
        $('#delete_selected').addClass('d-none');
        $('#select_all').on('click', function () {
            $('.row-checkbox').prop('checked', this.checked);
            toggleDeleteButton();
        });

        // If any checkbox is unchecked, uncheck the "select all" checkbox
        $('.row-checkbox').on('click', function () {
            toggleDeleteButton();
            if (!$(this).prop('checked')) {
                $('#select_all').prop('checked', false);
            }
            if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                $('#select_all').prop('checked', true);
            }
        });

        // Delete selected records
        $('#delete_selected').on('click', function () {
            const ids = $('.row-checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            if (ids.length > 0) {
                // Confirm deletion
                if (confirm('Are you sure you want to delete this records?')) {
                    $.ajax({
                        url: "{{route('delete_printer_queues')}}",
                        data: {
                            ids: ids,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                location.reload();
                                $('#flash-message-area').load(window.location.href +
                                    " #flash-message-area");
                            } else {
                                console.log('No success message in the response.');
                            }
                        }
                    });
                }
            } else {
                alert('Please select at least one record to delete.');
            }
        });

        // Function to show/hide the delete button based on selected checkboxes
        function toggleDeleteButton() {
            if ($('.row-checkbox:checked').length > 0) {
                $('#delete_selected').removeClass('d-none');
            } else {
                $('#delete_selected').addClass('d-none');
            }
        }
    });

    </script>
@endsection
@endsection
