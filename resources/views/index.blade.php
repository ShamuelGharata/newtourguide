<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Malang - Tourism Information</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        .filter-container {
            text-align: center;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .btn-filter {
            padding: 8px 20px;
            border: 2px solid #ff5722;
            border-radius: 25px;
            text-decoration: none;
            color: #ff5722;
            font-weight: 600;
            transition: 0.3s;
            background: white;
        }
        .btn-filter:hover, .btn-filter.active {
            background: #ff5722;
            color: white;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Explore <span>Malang</span></div>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#places">Places</a></li>
            <li><a href="#events">Events</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Discover the Best of Malang</h1>
            <p>Find attractions, restaurants, hotels, events, and the hidden gems of the city.</p>
            <a href="#places" class="btn-primary">Explore Now</a>
        </div>
    </section>

    {{-- Favorites Section --}}
    @if(Auth::check() && isset($favorites) && $favorites->count() > 0)
        <section class="places" id="favorites" style="background: #fff9f5; padding: 60px 0;">
            <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h2 style="color: #ff5722; margin-bottom: 30px; text-align: center;">⭐ Your Favorites</h2>
                <div class="place-grid"> 
                    @foreach($favorites as $place)
                        <div class="place-card"> 
                            <img src="{{ asset($place->image_url ?? 'images/default.jpg') }}" alt="{{ $place->name }}">
                            <div class="place-card-content">
                                <h3>{{ $place->name }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit($place->description, 100) }}</p>
                                <a href="{{ route('place.show', $place->id) }}" class="btn-view-details">View Details →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 0;">
    @endif

    {{-- Popular Places Section --}}
    <section class="places" id="places" style="padding: 60px 0;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <h2 style="text-align: center; margin-bottom: 20px;">Popular Places</h2>

            {{-- Category Filter Buttons --}}
            <div class="filter-container">
                {{-- "All" Button --}}
                <a href="{{ route('home') }}" class="btn-filter {{ !request('category_id') ? 'active' : '' }}">All</a>

                {{-- Dynamic Buttons from Database --}}
                @foreach($categories as $cat)
                    <a href="{{ route('home', ['category_id' => $cat->id]) }}" 
                    class="btn-filter {{ request('category_id') == $cat->id ? 'active' : '' }}">
                    {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div id="places-data"> 
                <div class="place-grid">
                    @foreach($places as $place)
                    <div class="place-card">
                        <img src="{{ asset($place->image_url ?? 'images/default.jpg') }}" alt="{{ $place->name }}">
                        <div class="place-card-content">
                            <h3>{{ $place->name }}</h3>
                            <p>{{ Str::limit($place->description, 100) }}</p>
                            <a href="{{ route('place.show', $place->id) }}" class="btn-view-details">View Details →</a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {!! $places->appends(request()->query())->links() !!}
                </div>
            </div>
        </div>
    </section>

    <section class="events" id="events">
        <h2 style="text-align: center;">Upcoming Events</h2>
        <div id="events-data">
            <div class="event-grid">
                @foreach($events as $event)
                <div class="event-card">
                    <h3>{{ $event->name }}</h3>
                    <p>{{ $event->description }}</p>
                    <span class="badge">{{ $event->date ?? 'TBA' }}</span>
                </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {!! $events->links() !!}
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 Explore Malang — Tourism Information System</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let containerId = $(this).closest('section').attr('id');
            let dataSelector = '#' + containerId + '-data';

            $.ajax({
                url: url,
                success: function(data) {
                    $(dataSelector).html($(data).find(dataSelector).html());
                    $('html, body').animate({
                        scrollTop: $("#" + containerId).offset().top - 100
                    }, 500);
                }
            });
        });
    </script>
</body>
</html>