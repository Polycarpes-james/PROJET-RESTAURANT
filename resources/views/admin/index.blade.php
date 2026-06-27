@extends('admin.base')

@section('title', 'DASHBOARD')
    
@section('content')
<<div id="chart-modal" class="modal">

    <div class="modal-content">


        <button id="close-modal">
            X
        </button>


        <h2 id="modal-title"></h2>


        <div id="modal-description"></div>


        <p id="modal-price"></p>


    </div>

</div>
    <div class="dashboard-charts">
        <div>
            <h1>Chiffres d'affaires pour les commandes</h1>
            <div class="container-canvas-commandes">
                <canvas id="salesChartCommandes"></canvas>
            </div>
        </div>

        <div>    
            <h1>Chiffres d'affaires pour les reservations</h1>
            <div class="container-canvas-reservations">
                <canvas id="salesChartReservations"></canvas>
            </div>
        </div>
    </div>
@endsection

<script>
    window.commandes = @json($commandes);
    window.reservations = @json($reservations);
    console.log(window.commandes);
    
</script>