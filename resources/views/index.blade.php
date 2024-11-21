@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="bubble fade-in-up mb-5 banner">
            <img src="{{ asset('assets/banner.jpg') }}" class="banner-img" />
            <div class="banner-text">
                {{ Carbon\Carbon::now()->setTimezone('America/New_York')->format('F j, Y') }}
            </div>
            <div class="banner-right p-3 sm:p-6">
                <h1 class="banner-h1 aboreto mb-1">Daily Devotional</h1>
                <p class="martel">Connecting with Christ Through Daily Reflection</p>
            </div>
        </div>
        <div class="bubble my-3 devotional fade-in-up">
            <div class="devotional-container martel">
                <div class="headings">
                    <h1>The Power of Gratitude</h1>
                    <h2>A Reflection on Living with a Thankful Heart</h2>
                    <div class="heading-border"></div>
                </div>
                <div class="devotional-text">
                    <x-devotion.verse
                        link="https://www.biblegateway.com/passage/?search=1%20Thessalonians%205%3A18&version=NIV"
                        reference="1 Thessalonians 5:18"
                        version="NIV"
                    >
                        Give thanks in all circumstances; for this is God’s will for you in Christ Jesus.
                    </x-devotion.verse>
                    <x-devotion.heading heading="Introduction" />
                    <p>In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives. Gratitude is more than just saying "thank you"—it is an attitude of the heart, a lens through which we see God's faithfulness. Today, let us reflect on the importance of cultivating gratitude in every season, whether in times of abundance or adversity.</p>
                    <x-devotion.heading heading="Living a Life of Thanks" />
                    <p>Gratitude shifts our focus from what we lack to what we have. It opens our eyes to the countless ways God works in our lives daily. When we choose to give thanks, we align our hearts with His will, allowing His peace to dwell within us.</p>
                    <p>Consider these steps to practice gratitude:</p>
                    <ol>
                        <li><strong>Pause and Reflect:</strong> Take a moment each day to recount three things you are grateful for.</li>
                        <li><strong>Express Gratitude to Others:</strong> A kind word or a note of thanks can brighten someone’s day and reinforce your own thankfulness.</li>
                        <li><strong>Praise God in Prayer:</strong> Begin your prayers with thanksgiving, acknowledging His goodness and provision.</li>
                    </ol>
                    <x-devotion.heading heading="Scripture Highlight" />
                    <p>One of the most profound stories of gratitude in the Bible is found in Luke 17, where Jesus heals ten lepers, but only one returns to thank Him. Jesus asks, "Were not all ten cleansed? Where are the other nine?" (Luke 17:17, NIV). This story reminds us that gratitude is not only a response to blessing but also a choice to honor God.</p>
                    <x-devotion.heading heading="Gratitude Challenge" />
                    <p>This week, keep a gratitude journal. Each evening, write down:</p>
                    <ul>
                        <li>One thing that made you smile.</li>
                        <li>One way you saw God’s hand in your day.</li>
                        <li>One challenge that helped you grow.</li>
                    </ul>
                    <x-devotion.heading heading="Closing Verse" />
                    <x-devotion.verse
                        link="https://www.biblegateway.com/passage/?search=Psalm%20100%3A4&version=NIV"
                        reference="Psalm 100:4"
                        version="NIV"
                    >
                        Enter his gates with thanksgiving and his courts with praise; give thanks to him and praise his name.
                    </x-devotion.verse>
                    <x-devotion.heading heading="Prayer" />
                    <p>Heavenly Father, thank You for Your abundant blessings. Teach us to have grateful hearts in all circumstances. Help us to see Your goodness even in difficult times, and may our gratitude be a witness to Your love and faithfulness. In Jesus’ name, Amen.</p>
                </div>
            </div>
            {{-- <div class="marker-1"></div>
            <div class="marker-4"></div>
            <div class="marker-3"></div> --}}
        </div>
    <div>
@endsection