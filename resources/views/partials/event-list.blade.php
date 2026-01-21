@foreach($events as $event)
<x-user.event-card 
    :title="$event->judul" 
    :date="$event->tanggal_waktu" 
    :location="$event->lokasi"
    :price="$event->tikets_min_harga" 
    :image="$event->gambar" 
    :href="route('events.show', $event)" />
@endforeach
