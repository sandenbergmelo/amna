@session('success')
    <p>{{ session('success') }}</p>
@endsession
@if ($user->eventRegistrations->isEmpty())
    <p>Você não está inscrito em nenhum evento</p>
@endif
@foreach ($user->eventRegistrations as $event)
    <section class="bg-white flex my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300" style="font-size: 1.2em;">
        <h3 class="text-lg font-bold">{{ $event->title }}</h3>
        @if ($event->image_path)
            <img class="pe-4" src="{{ asset($event->image_path) }}" alt="{{ $event->title }}">
        @endif
        <p>{{ $event->description ?? 'Sem descrição disponível.' }}</p>
        <p>Status: {{ $event->pivot->status_presence == 'Confirmed' ? 'Confirmado' : 'Pendente' }}</p>
        @if ($event->pivot->status_presence == 'Pending')
            {{-- Confirm presence --}}
            <form action="{{ route('event-registration.update', ['id' => $event->pivot->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="w-full py-2 flex flex-col">
                    <input type="hidden" name="status_presence" value="Confirmed">
                    <button class="text-black text-center font-semibold py-2 transition duration-300 cursor-pointer" type="submit">Confirmar presença</button>
                </div>
            </form>
        @else
            {{-- Cancel presence --}}
            <form action="{{ route('event-registration.update', ['id' => $event->pivot->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="w-full py-2 flex flex-col">
                    <input type="hidden" name="status_presence" value="Pending">
                    <button class="text-black text-center font-semibold py-2 transition duration-300 cursor-pointer" type="submit">Cancelar presença</button>
                </div>
            </form>
        @endif
    </section>
@endforeach