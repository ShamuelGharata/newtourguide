<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $place->name }} - Explore Malang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="background: #f8f9fa;">

    <nav class="navbar">
        <div class="logo">Explore <span>Malang</span></div>
        <ul>
            <li><a href="{{ route('home') }}">← Back to Home</a></li>
        </ul>
    </nav>

    <div style="max-width: 1000px; margin: 50px auto; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        
        <img src="{{ asset($place->image_url ?? 'images/default.jpg') }}" 
            style="width: 100%; height: 450px; object-fit: cover;">

        <div style="padding: 40px;">
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            <h1 style="font-size: 36px; margin-bottom: 10px;">{{ $place->name }}</h1>
            <p style="color: #666; font-size: 18px; line-height: 1.6; margin-bottom: 20px;">{{ $place->description }}</p>
            @auth
                <div style="margin-top: 15px; margin-bottom: 40px; display: flex; align-items: center;">
                    <form action="{{ route('favorite.toggle', $place->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: white; border: 1px solid #ddd; padding: 10px 22px; border-radius: 30px; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.05); outline: none;">
                            <span style="font-size: 24px; color: #ffb400; line-height: 1;">
                                @if(Auth::user()->favorites && Auth::user()->favorites->contains($place->id))
                                    ★
                                @else
                                    ☆
                                @endif
                            </span>
                            <span style="font-weight: 600; color: #444; font-size: 16px; font-family: 'Poppins', sans-serif;">Favorite</span>
                        </button>
                    </form>
                </div>
            @endauth

            <div style="margin-bottom: 30px; padding: 20px; background: #fff5f2; border-radius: 12px; border-left: 5px solid #ff5722; display: flex; flex-wrap: wrap; gap: 20px;">
                <div style="flex: 1; min-width: 250px;">
                    <h4 style="margin: 0 0 5px 0; color: #ff5722; font-size: 14px; text-transform: uppercase;">Location</h4>
                    <p style="margin: 0; color: #333; font-weight: 500;">
                        📍 {{ $place->address ?? 'Address not available' }}
                    </p>
                    @if($place->address)
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($place->address) }}" target="_blank" style="font-size: 12px; color: #ff5722; text-decoration: none; font-weight: bold;">View on Google Maps →</a>
                    @endif
                </div>
                <div style="flex: 1; min-width: 200px;">
                    <h4 style="margin: 0 0 5px 0; color: #ff5722; font-size: 14px; text-transform: uppercase;">Contact</h4>
                    <p style="margin: 0; color: #333; font-weight: 500;">
                        📞 @if($place->phone)
                            <a href="tel:{{ $place->phone }}" style="color: #333; text-decoration: none;">{{ $place->phone }}</a>
                        @else
                            <span style="color: #999;">Not listed</span>
                        @endif
                    </p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; border-top: 1px solid #eee; padding-top: 30px;">
                
                <div>
                    <h3 style="margin-bottom: 15px; color: #ff5722;">Facilities</h3>
                    <ul style="list-style: none; padding: 0; margin-bottom: 40px;">
                        @forelse($place->facilities as $facility)
                            <li style="margin-bottom: 8px;">✅ {{ $facility->name }}</li>
                        @empty
                            <li style="color: #999;">No facilities listed.</li>
                        @endforelse
                    </ul>

                    <div style="background: #f9f9f9; padding: 25px; border-radius: 12px; border: 1px solid #eee;">
                        <h3 style="margin-bottom: 15px;">Leave a Review</h3>
                        @auth
                            <form action="{{ route('review.store', $place->id) }}" method="POST">
                                @csrf
                                <div style="margin-bottom: 15px;">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Rating:</label>
                                    <select name="rating" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ddd;">
                                        <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                                        <option value="4">⭐⭐⭐⭐ (Good)</option>
                                        <option value="3">⭐⭐⭐ (Average)</option>
                                        <option value="2">⭐⭐ (Poor)</option>
                                        <option value="1">⭐ (Terrible)</option>
                                    </select>
                                </div>

                                <div style="margin-bottom: 15px;">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Comment:</label>
                                    <textarea name="comment" rows="4" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ddd; resize: none;" placeholder="Share your experience..." required></textarea>
                                </div>

                                <button type="submit" style="width: 100%; background: #ff5722; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                                    Post Review
                                </button>
                            </form>
                        @else
                            <div style="text-align: center; padding: 10px;">
                                <p style="color: #666;">You must be logged in to post a review.</p>
                                <a href="{{ route('login') }}" style="color: #ff5722; font-weight: bold; text-decoration: none;">Login Here →</a>
                            </div>
                        @endauth
                    </div>
                </div>

                <div>
                    <h3 style="margin-bottom: 15px; color: #ff5722;">User Reviews</h3>
                    <div style="max-height: 600px; overflow-y: auto; padding-right: 10px;">
                        @forelse($place->reviews as $review)
                            <div style="background: #fff9f5; padding: 20px; border-radius: 10px; margin-bottom: 15px; border-left: 5px solid #ff5722;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                    <span style="font-weight: bold; color: #333;">
                                        👤 {{ $review->user->name ?? 'Explorer' }}
                                    </span>
                                    <span style="color: #ffb400; font-weight: bold;">⭐ {{ $review->rating }}/5</span>
                                </div>
                                <p style="font-style: italic; color: #555; line-height: 1.5; margin: 0;">
                                    "{{ $review->comment }}"
                                </p>
                                <small style="color: #999; display: block; margin-top: 10px;">
                                    {{ $review->created_at ? $review->created_at->diffForHumans() : 'Recently' }}
                                </small>
                            </div>
                        @empty
                            <p style="color: #999; text-align: center; margin-top: 20px;">No reviews yet. Be the first to share your thoughts!</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>