@extends('layouts.dashBoard')

@section('content')
    <h1 class="mb-4 text-center">Agregar Tienda</h1>
    <div class="container pb-5">
		<div class="row justify-content-center">
			<div class="col-12 col-md-2 col-lg-2"></div>
			<div class="col-12 col-md-8 col-lg-8">
                <form action="{{route('mantenimiento-tiendas.store')}}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3">
                            <label for="departament">Departamento: </label>
                            <select name="departament" id="departament" class="form-control" onChange="getProvinces()">
                                <option value="" disabled selected> Seleccione</option>
                                @foreach($departaments as $departament)
                                    <option value="{{$departament->id}}">{{$departament->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="province">Provincia: </label>
                            <select name="province" id="province" class="form-control" onChange="getDistricts()">
                                <option value="" disabled selected> Seleccione</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="district">Distrito: </label>
                            <select name="district" id="district" class="form-control @error('district') is-invalid @enderror">
                                <option value="" disabled selected> Seleccione</option>
                            </select>
                            @error('district')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <label for="autocomplete" class="form-label">Ubicación</label>
                    <div class="input-group mb-3">
                        <input type="text" id="autocomplete" placeholder="Ingresa el lugar de la tienda" class="form-control @error('direction') is-invalid @enderror" name="direction">
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="long" id="long">
                        @error('direction')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <div id="map" style="width: 100%; height: 250px; padding: 20px;"></div>
                        </div>
                    </div>
                    <label for="photo" class="form-label">Imagen</label>
                    <div class="input-group mb-3">
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" id="photo" accept=".png, .jpg, .jpeg">
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary pe-5 ps-5">Grabar ✔</button>
                </form>
            </div>
			<div class="col-12 col-md-2 col-lg-2"></div>
		</div>
	</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="/js/storesSupport/create.js"></script>
    <script src="/js/ubigeo.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiaRFk-6WOASUMIu1yfGszmrBV-A8bmdk&libraries=places&callback=initMap"></script>
@endsection