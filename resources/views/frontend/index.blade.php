@extends('frontend.layouts.master')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <style>
        .draggable.dragging {
            opacity: .5;
        }
        .cursor-pointer{
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <div class="container mt-5 pt-2">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0">
                    <div class="card-body bg-light">

                        {{-- card header  --}}
                        <div class="card-header bg-light">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-spinner"></i>
                                    <span class="ms-2">Common</span>
                                </div>
                                <div class="bg-white rounded px-4 py-2 text-gray">
                                    <i class="far fa-comment-dots"></i>
                                    <i class="fas fa-plus mx-2"></i>
                                    <i class="fas fa-bars"></i>

                                </div>
                            </div>
                        </div>
                        {{-- card content  --}}
                        <div class="mt-3">
                            @foreach ($cities as $city)
                                <div class="draggable my-4 px-3 cursor-pointer" draggable="true">
                                    <div>
                                        <i class="fas fa-spinner"></i>
                                        <span class="ms-2">{{ $city['name'] }}</span>
                                    </div>
                                    <div class="my-2">
                                        <img src="{{ asset($city['thumb']) }}" alt="{{ $city['name'] }}"
                                            class="img-fluid w-100" style="height: 100px;object-fit:cover">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
