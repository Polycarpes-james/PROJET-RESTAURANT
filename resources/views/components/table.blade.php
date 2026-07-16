<table class="styled-table">
    <thead>
        <tr>
            @foreach ($items as $item)
                <th>{{ $item }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($model as $item)
           <tr class="commande-row">
                <td><span class="classIdChange">#{{ $item->id }}</span></td>
                <td>
                    <div class="user-td">
                        <p class="bold">{{ $item->name ?? $item->user->name }}</p>
                        <p class="fs-2">{{ $item->email ?? $item->user->email}}</p>
                    </div>
                </td>
                <td><span style="font-weight:bold">{{ $item->total_price ?? $item->total_prix }} €</span></td>
                <td><span class="badge {{ $item->status === "en_attente" ? "nouveau" : ($item->status === "en_preparation" ? "encours" : ($item->status === "annulee" ? "annule" : "livre")) }}">{{ $item->status === "en_attente" ? "Nouveau" : ($item->status === "en_preparation" ? "En cours" : ($item->status === "annulee" ? "Annulée" : "Livrée")) }}</span></td>
                <td class="options">
                    <form action="{{ route($routeUpdate, $item) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{ $slot }}
                        <button type="submit">Changer</button>
                    </form>
                    <button type="button" data-commandeid="{{ $item->id }}" data-inviteid="{{ $item->invite_id }}" id="show" data-isguest="{{ $item->invite_id ? "true" : "false" }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>