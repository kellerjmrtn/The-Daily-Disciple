@php use Carbon\Carbon; @endphp

@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="search-container mb-5 martel">
            <form action="#" class="search-form">
                <input
                    type="text"
                    class="search-box"
                    placeholder="Search"
                />
                <button class="search-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="mb-5 devotional-card-container fade-in-up">
            @for($i = 0; $i < 5; $i++)
                <x-devotional-card
                    title="The Power of Gratitude"
                    subtitle="A Reflection on Living with a Thankful Heart"
                    excerpt="<p>In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives. Gratitude is more than just saying 'thank you'—it is an attitude of the heart, a lens through which we see God's faithfulness. Today, let us reflect on the importance of cultivating gratitude in every season, whether in times of abundance or adversity.</p><p>Gratitude shifts our focus from what we lack to what we have. It opens our eyes to the countless ways God works in our lives daily. When we choose to give thanks, we align our hearts with His will, allowing His peace to dwell within us.</p>"
                    link="{{ route('index') }}"
                    :date="Carbon::now()->setTimezone('America/New_York')"
                />
                <x-devotional-card
                    title="Steps of the Shepherd"
                    subtitle="Walking in the Path of Faithful Guidance"
                    excerpt="<p>In life, we often find ourselves searching for direction, longing for clarity amid uncertainty. Psalm 23:3 reminds us, 'He leads me in paths of righteousness for his name’s sake.' Like sheep following a shepherd, we are not meant to wander aimlessly. God, our Shepherd, gently leads us, not through chaotic demands or hurried schedules, but through a steady, intentional pace that aligns with His perfect will. Trusting His guidance means surrendering our need to control and instead stepping out in faith, one step at a time.</p><p>As you follow His steps today, remember that the Shepherd's path may not always seem direct or easy, but it is always purposeful. Through every valley and mountaintop, He is shaping your character, teaching you trust, and preparing you for what lies ahead. Pause and listen for His voice in your decisions and relationships, confident that His leading is for your ultimate good. Let His steps become yours, and find peace in knowing that He never leads where His grace cannot sustain.</p>"
                    link="{{ route('index') }}"
                    :date="Carbon::now()->subDays(1)->setTimezone('America/New_York')"
                    isPopular="true"
                />
                <x-devotional-card
                    title="Anchored in Grace"
                    excerpt="In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives."
                    link="{{ route('index') }}"
                    :date="Carbon::now()->subDays(2)->setTimezone('America/New_York')"
                    isRecommended="true"
                    scriptureReading="Hebrews 6:19-20"
                />
                <x-devotional-card
                    title="Heaven's Blueprint For Our Lives Continued"
                    subtitle="Finding God’s Plan in Everyday Moments"
                    excerpt="In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives."
                    link="{{ route('index') }}"
                    :date="Carbon::now()->subDays(3)->setTimezone('America/New_York')"
                />
                <x-devotional-card
                    title="Clay in His Hands"
                    subtitle="Molded for Purpose, Shaped by Grace"
                    excerpt="In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives."
                    link="{{ route('index') }}"
                    :date="Carbon::now()->subDays(4)->setTimezone('America/New_York')"
                />
                <x-devotional-card
                    title="Whispers of the Divine"
                    excerpt="In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives."
                    link="{{ route('index') }}"
                    :date="Carbon::now()->subDays(5)->setTimezone('America/New_York')"
                    isPopular="true"
                    isRecommended="true"
                />
            @endfor
        </div>
    </div>
@endsection