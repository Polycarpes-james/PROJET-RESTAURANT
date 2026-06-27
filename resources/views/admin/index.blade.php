@extends('admin.base')

@section('title', 'DASHBOARD')
    
@section('content')
    <canvas id="salesChartCommandes"></canvas>
    <canvas id="salesChartReservations"></canvas>
@endsection

<script>
    window.commandes = @json($commandes);
    window.reservations = @json($reservations);
</script>