<x-layouts.app>
    <div class="hero bg-blue-900 min-h-screen">
        <div class="hero-content text-center text-white">
            <div class="max-w-4xl">
                <h1 class="text-5xl font-bold">Hi, Amankan Tiketmu yuk.</h1>
                <p class="py-6">
                    BengTix: Beli tiket, auto asik.
                </p>
            </div>
        </div>
    </div>

    <section id="event-section" class="max-w-7xl mx-auto py-12 px-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black uppercase italic">Event</h2>
            <div class="flex gap-2">
                <a href="{{ route('home') }}" class="category-link" data-id="">
                    <x-user.category-pill :label="'Semua'" :active="!request('kategori')" />
                </a>
                @foreach($categories as $kategori)
                <a href="{{ route('home', ['kategori' => $kategori->id]) }}" class="category-link" data-id="{{ $kategori->id }}">
                    <x-user.category-pill :label="$kategori->nama" :active="request('kategori') == $kategori->id" />
                </a>
                @endforeach
            </div>
        </div>

        <div id="events-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 min-h-[200px]">
            @include('partials.event-list')
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.category-link').on('click', function(e) {
                e.preventDefault();
                
                let url = $(this).attr('href');
                let categoryId = $(this).data('id');
                
                // Update URL without refresh
                window.history.pushState({path: url}, '', url);
                
                // Define classes
                const activeClasses = '!bg-blue-800 !text-white hover:!bg-blue-800';
                const inactiveClasses = 'bg-white border-blue-900 text-blue-900 hover:bg-blue-900 hover:text-white';
                
                // Update active state visually
                // Reset all buttons to inactive state
                $('.category-link button').removeClass(activeClasses).addClass(inactiveClasses);
                
                // Set clicked button to active state
                $(this).find('button').removeClass(inactiveClasses).addClass(activeClasses);
                
                // Show loading state (optional)
                $('#events-container').addClass('opacity-50');

                // Fetch data
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#events-container').html(response).removeClass('opacity-50');
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                        $('#events-container').removeClass('opacity-50');
                    }
                });
            });
        });
    </script>
</x-layouts.app>