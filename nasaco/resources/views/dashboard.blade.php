@extends('layouts.app',['activemenuitem'=>'dashboard'])

@section('content')
    <input id="import-excel" type="file" name="xlfile" id="xlf">
@endsection

@push('scripts')
    <script src="js/dashboard.js"></script>
@endpush