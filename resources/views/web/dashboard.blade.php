@extends('layouts.main')
@section('content')
    <div class="row g-0 mt-3">
        <div class="col-lg-5 col-xl-5 ps-lg-2 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                    <h6 class="mb-0">All Pending Prints</h6>
                    <a class="py-1 fs-10 font-sans-serif" href="#!">View All</a>
                </div>
                <div class="card-body pb-0">
                    @for ($i = 1; $i < 6; $i++)
                        <div class="d-flex mb-3 hover-actions-trigger align-items-center">
                            <div class="file-thumbnail">
                                <img class="border h-100 w-100 object-fit-cover rounded-2" src="/assets/img/products/5-thumb.png" alt="" />
                            </div>
                            <div class="ms-3 flex-shrink-1 flex-grow-1">
                                <h6 class="mb-1">
                                    <a class="stretched-link text-900 fw-semi-bold" href="#!">apple-smart-watch.png</a>
                                </h6>
                                <div class="fs-10"><span class="fw-semi-bold">Mark Harision</span>
                                    <span class="fw-medium text-600 ms-2">10/03/2024</span>
                                </div>
                                <div class="hover-actions end-0 top-50 translate-middle-y d-block">
                                    <a class="btn btn-tertiary border-300 btn-sm me-1 text-600" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Print Now" download="Print Now">
                                        {{-- <img src="assets/img/icons/printer-icon.svg" alt="" width="15" /> --}}
                                        <i class="bi bi-printer"></i>
                                        </a>
                                    <button class="btn btn-tertiary border-300 btn-sm me-1 text-600 shadow-none" type="button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr class="text-200" />
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
