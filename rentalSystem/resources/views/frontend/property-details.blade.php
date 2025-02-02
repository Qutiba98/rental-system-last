<!-- resources/views/frontend/about.blade.php -->
@extends('layouts.master')

@section('title', 'Property Details')

@section('content')
<style>
.rating .stars i {
    font-size: 24px;
    color: #ccc; /* Default star color */
    cursor: pointer;
    transition: color 0.3s ease;
}

.rating .stars i.selected,
.rating .stars i:hover,
.rating .stars i:hover ~ i {
    color: #f39c12; /* Color for selected or hovered stars */
}

.rating .stars i:hover ~ i {
    color: #ccc; /* Revert color of stars to the right */
}


</style>
<!-- Property Details Section Begin -->
<section class="property-details-section">
    @if (session('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('commentError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('commentError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="property-pic-slider slider owl-carousel">



        <div class="ps-item">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 p-0">
                                <div class="ps-item-inner large-item set-bg" data-setbg="{{ asset('storage/'.$propertPhoto[0]->photo_url) }}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-6 p-0">
                                <div class="ps-item-inner set-bg" data-setbg=" {{ asset('storage/'.$propertPhoto[1]->photo_url) }}"></div>
                            </div>
                            <div class="col-sm-6 p-0">
                                <div class="ps-item-inner set-bg" data-setbg="{{ asset('storage/'.$propertPhoto[2]->photo_url) }}"></div>
                            </div>
                            <div class="col-sm-6 p-0">
                                <div class="ps-item-inner set-bg" data-setbg="{{ asset('storage/'.$propertPhoto[3]->photo_url) }}"></div>
                            </div>
                            <div class="col-sm-6 p-0">
                                <div class="ps-item-inner set-bg" data-setbg="{{ asset('storage/'.$propertPhoto[4]->photo_url) }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="ps-item">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 p-0">
                                <div class="ps-item-inner large-item set-bg" data-setbg="{{ asset('img/property/slider/ps-1.jpg') }}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-6 p-0">
                                <div class="ps-item-inner set-bg" data-setbg="{{ asset('img/property/slider/ps-2.jpg') }}"></div>
                            </div>
                            <div class="col-sm-6 p-0">
                                <div class="ps-item-inner set-bg" data-setbg="{{ asset('img/property/slider/ps-2.jpg') }}"></div>
                            </div>
                            <div class="col-sm-6 p-0">
                                <div class="ps-item-inner set-bg" data-setbg="{{ asset('img/property/slider/ps-4.jpg') }}"></div>
                            </div>
                            <div class="col-sm-6 p-0">
                                <div class="ps-item-inner set-bg" data-setbg="{{ asset('img/property/slider/ps-5.jpg') }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="pd-text">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="pd-title">
                                {{-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> --}}
                                <div class="label" style="{{ $property->availability == 1 ? 'background-color:green;' : 'background-color:red;' }}">
                                    {{ $property->availability == 1 ? 'available' : 'rented' }}
                                </div>
                                <div class="pt-price">{{ $property->price_per_day }}<span>/day</span></div>
                                <h3>{{ $property->title }}</h3>
                                <p><span class="icon_pin_alt"></span> {{ $property->address }}</p>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="pd-social">

                                <a href="#"><i class="fa fa-mail-forward"></i></a>
                                <a href="#"><i class="fa fa-send"></i></a>
                                <a href="#"><i class="fa fa-heart"></i></a>
                                <a href="#"><i class="fa fa-mail-forward"></i></a>
                                <a href="#"><i class="fa fa-cloud-download"></i></a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="pd-board">
                        <div class="tab-board">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Description</a>
                                </li>

                            </ul><!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel" >
                                    <div class="tab-details">
                                        <ul class="left-table"style="padding-left: 0; !importent">
                                            <li>
                                                <span class="type-name">Property Type</span>
                                                <span class="type-value">House</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Rating</span>
                                                <span class="type-value">
                                                    @php
                                                    $sum = 0;
                                                    @endphp
                                                    @foreach ($reviews as $review)
                                                        @php
                                                         $sum += $review->rating
                                                         @endphp
                                                    @endforeach
                                                    @if ($sum != 0)

                                                    {{ number_format($sum/$countOfReview , 1) }} of 5
                                                    @endif
                                                    @if ($sum == 0)

                                                    No Review
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <span class="type-name">Price</span>
                                                <span class="type-value">${{ $property->price_per_day }}/Day</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Year Built</span>
                                                <span class="type-value">2019</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Contract type</span>
                                                <span class="type-value">Rent</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Agent</span>
                                                <span class="type-value">{{ $property->user->name }}</span>
                                            </li>
                                        </ul>
                                        <ul class="right-table"style="padding-left: 0; !importent">
                                            <li>
                                                <span class="type-name">Home Area</span>
                                                <span class="type-value">1200 sqft</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Rooms</span>
                                                <span class="type-value">{{ $property->number_of_rooms }}</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Bedrooms</span>
                                                <span class="type-value">{{ $property->number_of_bedrooms }}</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Bathrooms</span>
                                                <span class="type-value">{{ $property->number_of_bathrooms }}</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Garages</span>
                                                <span class="type-value">{{ $property->number_of_garage }}</span>
                                            </li>
                                            <li>
                                                <span class="type-name">Amenities</span>
                                                <span class="type-value">
                                                    @if ($property->AC == 1)
                                                        AC
                                                    @endif
                                                    @if ($property->WIFI == 1)
                                                    WIFI
                                                    @endif
                                                    @if ($property->pool == 1)
                                                    Pool
                                                    @endif
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <div class="tab-desc">
                                        <p>{{ $property->description }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="pd-widget" >
                        <h4>{{ $countOfReview }} reviews</h4>
                        <div class="pd-review"style="overflow-y: auto; max-height: 260px;">
                            @foreach ($reviews as $review )

                            <div class="pr-item">
                                <div class="pr-avatar">
                                    <div class="pr-pic">
                                        <img src="{{ Storage::url($property->user->profile_picture) }}" alt="">
                                    </div>
                                    <div class="pr-text">
                                        <h6>{{ $review->renter->name }}</h6>
                                        <span>{{ $review->created_at->format('d M Y') }}</span>
                                        <div class="pr-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ $review->rating >= $i ? '' : '-o' }}"></i>
                                        @endfor
                                        </div>
                                    </div>
                                </div>
                                <p>{{ $review->comment }}</p>
                                          </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="pd-widget">
                        <h4>Your Rating</h4>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                 {{ session('success') }}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            </div>
                        @endif



                        <form action="  {{ route('submitReview' ,$property->id) }}" method="POST" class="review-form">
                            @csrf <!-- Ensure you include this if youre using Laravel for CSRF protection -->
                            <div class="group-input">
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <input type="hidden" name="renter_id" value="{{  Auth::id() }}">
                                <input type="number" name="rating" id="rating" hidden>
                                <textarea type="text" name="comment" placeholder="Your comment" required style="max-width: 47vw"></textarea>
                            </div>



                            <div class="rating">
                                <span>Your Rating:</span>
                                <div class="stars">
                                    <i class="fa fa-star" data-value="1"></i>
                                    <i class="fa fa-star" data-value="2"></i>
                                    <i class="fa fa-star" data-value="3"></i>
                                    <i class="fa fa-star" data-value="4"></i>
                                    <i class="fa fa-star" data-value="5"></i>
                                </div>
                            </div>
                            <button type="submit" class="site-btn">Send Review</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="property-sidebar">
                    <div class="single-sidebar">
                        <div class="section-title sidebar-title">
                            <h5>Owner</h5>
                        </div>
                        <div class="top-agent">
                            <div class="ta-item">
                                <div class="ta-pic set-bg" data-setbg="{{ Storage::url($property->user->profile_picture) }}"></div>
                                <div class="ta-text">
                                    <h6><a  style="text-decoration: none">{{ $property->user->name }}</a></h6>
                                    {{-- <span>Team Leader</span> --}}
                                    <div class="ta-num">{{ $property->user->phone_number }}</div>
                                </div>
                            </div>

                        </div>
                    </div>

                   <div class="single-sidebar">
                       @if (session('successBook'))
                                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('successBook') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                               </div>
                                               @endif
                       @if (session('bookingError'))
                                           <div class="alert alert-danger   alert-dismissible fade show" role="alert">
                                                {{ session('bookingError') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                               </div>
                                               @endif
    <div class="section-title sidebar-title">
        <h5>Mortgage Calculator</h5>
    </div>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}<!-- Flatpickr CSS -->

<!-- Booking Form -->
<form action="{{ route('bookings.store', $property->id) }}" method="POST" class="calculator-form">
    @csrf
    <input type="hidden" id="property_id" name="property_id" value="{{ $property->id }}">


    <div class="filter-input">
        <p>Start Date</p>
        <input type="text" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
    </div>

    <div class="filter-input">
        <p>End Date</p>
        <input type="text" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
    </div>

    <div class="filter-input">
        <p>Total Price</p>
        <input type="text" id="total_price" name="total_price" placeholder="$" value="{{ $property->price_per_day }}" required>
    </div>

    <button type="submit" class="site-btn">Book</button>
</form>

<!-- Flatpickr JS -->
<script src='https://cdn.jsdelivr.net/npm/flatpickr'></script>


</div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Property Details Section End -->
<section class="property-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4>Related Proprty</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @if($properties->isNotEmpty())
                @foreach ($properties as $property)
                    <div class="col-lg-4 col-md-6">
                        <div class="property-item">
                            <div class="pi-pic set-bg" data-setbg="{{ asset('storage/' . $property->photos->first()->photo_url) }}">
                                <div class="label" style="{{ $property->availability == 1 ? 'background-color:green;' : 'background-color:red;' }}">
                                    {{ $property->availability == 1 ? 'available' : 'rented' }}
                                </div>
                            </div>
                            <div class="pi-text">
                                <div class="pt-price">{{ $property->price_per_day }}<span>/Day</span></div>
                                <h5><a href="{{ route('viewProperty', ['id' => $property->id]) }}" style="text-decoration: none;">{{ $property->title }}</a></h5>
                                <p><span class="icon_pin_alt"></span> {{ $property->location }}</p>
                                <ul>
                                    <li><i class="fa fa-bathtub"></i> {{ $property->number_of_bathrooms }}</li>
                                    <li><i class="fa fa-bed"></i> {{ $property->number_of_bedrooms }}</li>
                                    <li><i class="fa fa-automobile"></i> {{ $property->number_of_garage }}</li>
                                </ul>
                                <div class="pi-agent">
                                    <div class="pa-item">
                                        <div class="pa-info">
                                            <img src="{{ Storage::url($property->user->profile_picture) }}" alt="Profile Picture">
                                            <h6>{{ $property->user->name }}</h6>
                                        </div>
                                        <div class="pa-text">
                                            {{ $property->user->phone_number }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            <p style="text-align: center; color: #999; font-size: 1.2rem; padding: 20px;">No Property Related to the Owner.</p>
            @endif
        </div>

        {{-- Uncomment this if you want to add a Load More button later --}}
        {{-- <div class="loadmore-btn">
            <a href="#">Load more</a>
        </div> --}}


<!-- Contact Section Begin -->
<link href='https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css' rel='stylesheet' />

    <script>
         document.addEventListener('DOMContentLoaded', function () {
        var bookedDates = @json($bookedDates);

        var disabledDates = bookedDates.flatMap(dateRange => {
            const start = new Date(dateRange.start_date);
            const end = new Date(dateRange.end_date);
            let dates = [];

            while (start <= end) {
                dates.push(start.toISOString().split('T')[0]); // Format as yyyy-mm-dd
                start.setDate(start.getDate() + 1);
            }

            return dates;
        });

        flatpickr("#start_date", {
            minDate: "today",
            disable: disabledDates,
            onChange: function(selectedDates, dateStr, instance) {
                var endDateInput = document.getElementById('end_date');
                endDateInput.disabled = false;
                flatpickr("#end_date").set('minDate', dateStr);
            }
        });

        flatpickr("#end_date", {
            minDate: "today",
            disable: disabledDates
        });
    });
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating .stars i');
    const ratingInput = document.getElementById('rating');

    stars.forEach((star) => {
        // Handle click event
        star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;

            // Remove 'selected' class from all stars
            stars.forEach(s => s.classList.remove('selected'));

            // Add 'selected' class to the clicked star and all preceding stars
            this.classList.add('selected');
            let prev = this.previousElementSibling;
            while (prev) {
                prev.classList.add('selected');
                prev = prev.previousElementSibling;
            }
        });

        // Handle mouseover event
        star.addEventListener('mouseover', function() {
            // Add hover effect to the current star and all preceding stars
            this.classList.add('hover');
            let prev = this.previousElementSibling;
            while (prev) {
                prev.classList.add('hover');
                prev = prev.previousElementSibling;
            }
        });

        // Handle mouseout event
        star.addEventListener('mouseout', function() {
            // Remove hover effect from all stars
            stars.forEach(s => s.classList.remove('hover'));
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const propertyPrice = parseFloat('{{ $property->price_per_day  }}');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const totalPriceInput = document.getElementById('total_price');

    function calculateTotalPrice() {
        const startDateValue = startDateInput.value;
        const endDateValue = endDateInput.value;

        if (startDateValue && endDateValue) {
            const startDate = new Date(startDateValue);
            const endDate = new Date(endDateValue);

            if (endDate >= startDate) {
                const days = (endDate - startDate) / (1000 * 60 * 60 * 24);
                totalPriceInput.value = (days * propertyPrice).toFixed(2);
            } else {
                totalPriceInput.value = '';
            }
        } else {
            totalPriceInput.value = '';
        }
    }

    startDateInput.addEventListener('input', calculateTotalPrice);
    endDateInput.addEventListener('input', calculateTotalPrice);
});

    </script>

</section>
<!-- Contact Section End -->
@endsection

