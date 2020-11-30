@extends('frontend.layouts.template_02')
<style type="text/css">
            #mapDiv { width: 800px; height: 500px; }
        </style>
@section('main')
<main id="main" class="site-main">
    <div class="site-content">

        <div class="container-fluid">

           {{--  <div class="form-group">
                <label for="address_address">Address</label>
                <input type="text" id="address-input" name="address_address" class="form-control map-input">
                <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
            </div>
            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="mapDiv"></div>
            </div> --}}
            <div class="field-group">
                <input type="text" id="pac-input" placeholder="{{__('Full Address')}}" value="" name="address" autocomplete="off" required/>
            </div>
            <div class="field-group field-maps">
                <div class="field-map">
                    <input type="hidden" id="place_lat" name="lat" value="">
                    <input type="hidden" id="place_lng" name="lng" value="">
                    <div class="Show_map" id="map" style=" position: relative; overflow: hidden;"></div>
                </div>
            </div>

        </div>
    </div>
</main>
@stop
@push('scripts')
  <!-- Map creation is here -->
<script src="{{asset('assets/js/map.js')}}"></script>
@endpush
