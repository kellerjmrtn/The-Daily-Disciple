@extends('layouts.app')

@section('navLeft')
    <div class="nav-date">
        {{ $devotion->date->format('F j, Y') }}
        <span class="separator hidden md:inline-block"></span>
        <strong class="hidden md:inline">{{ $devotion->title }}</strong>
    </div>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="bubble fade-in-up mb-5 banner">
            <img src="{{ asset('assets/banner.jpg') }}" class="banner-img" />
            <div class="banner-text">
                {{ $devotion->date->format('F j, Y') }}
            </div>
        </div>
        @if (!$devotion->isVisible())
            <div class="bubble my-5 bg-yellow-100 text-yellow-700 p-4 martel">
                Warning: This devotion is not publicly visible
            </div>
        @endif
        <div class="bubble my-5 devotional fade-in-up">
            <div class="devotional-container martel">
                <div class="headings">
                    <h1>{{ $devotion->title }}</h1>
                    @if ($devotion->subtitle)
                        <h2>{{ $devotion->subtitle }}</h2>
                    @endif
                    <div class="heading-border"></div>
                </div>
                <div class="devotional-text">
                    {!! $devotion->content !!}
                    {{-- <x-devotion.verse
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
                    <p>Heavenly Father, thank You for Your abundant blessings. Teach us to have grateful hearts in all circumstances. Help us to see Your goodness even in difficult times, and may our gratitude be a witness to Your love and faithfulness. In Jesus’ name, Amen.</p> --}}
                </div>
            </div>
        </div>
        <div class="bubble-break fade-in-up">
            <h2 class="break-heading martel">Continue Reading</h2>
        </div>
        <div class="devotional-card-container my-5 fade-in-up slider">
            @foreach ($continueReading as $devotional)
                <x-devotion-card :devotion="$devotional" />
            @endforeach
            {{-- <x-devotional-card
                title="The Power of Gratitude"
                subtitle="A Reflection on Living with a Thankful Heart"
                excerpt="<p>In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives. Gratitude is more than just saying 'thank you'—it is an attitude of the heart, a lens through which we see God's faithfulness. Today, let us reflect on the importance of cultivating gratitude in every season, whether in times of abundance or adversity.</p><p>Gratitude shifts our focus from what we lack to what we have. It opens our eyes to the countless ways God works in our lives daily. When we choose to give thanks, we align our hearts with His will, allowing His peace to dwell within us.</p>"
                link="{{ route('index') }}"
                :date="Carbon\Carbon::now()->setTimezone('America/New_York')"
            />
            <x-devotional-card
                title="Steps of the Shepherd"
                subtitle="Walking in the Path of Faithful Guidance"
                excerpt="<p>In life, we often find ourselves searching for direction, longing for clarity amid uncertainty. Psalm 23:3 reminds us, 'He leads me in paths of righteousness for his name’s sake.' Like sheep following a shepherd, we are not meant to wander aimlessly. God, our Shepherd, gently leads us, not through chaotic demands or hurried schedules, but through a steady, intentional pace that aligns with His perfect will. Trusting His guidance means surrendering our need to control and instead stepping out in faith, one step at a time.</p><p>As you follow His steps today, remember that the Shepherd's path may not always seem direct or easy, but it is always purposeful. Through every valley and mountaintop, He is shaping your character, teaching you trust, and preparing you for what lies ahead. Pause and listen for His voice in your decisions and relationships, confident that His leading is for your ultimate good. Let His steps become yours, and find peace in knowing that He never leads where His grace cannot sustain.</p>"
                link="{{ route('index') }}"
                :date="Carbon\Carbon::now()->subDays(1)->setTimezone('America/New_York')"
                isPopular="true"
            />
            <x-devotional-card
                title="Anchored in Grace"
                excerpt="In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives."
                link="{{ route('index') }}"
                :date="Carbon\Carbon::now()->subDays(2)->setTimezone('America/New_York')"
                isRecommended="true"
                scriptureReading="Hebrews 6:19-20"
            />
            <x-devotional-card
                title="Heaven's Blueprint For Our Lives Continued"
                subtitle="Finding God’s Plan in Everyday Moments"
                excerpt="In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives."
                link="{{ route('index') }}"
                :date="Carbon\Carbon::now()->subDays(3)->setTimezone('America/New_York')"
            />
            <x-devotional-card
                title="Clay in His Hands"
                subtitle="Molded for Purpose, Shaped by Grace"
                excerpt="In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives."
                link="{{ route('index') }}"
                :date="Carbon\Carbon::now()->subDays(4)->setTimezone('America/New_York')"
            />
            <x-devotional-card
                title="Whispers of the Divine"
                excerpt="In a world filled with distractions and challenges, it’s easy to overlook the blessings in our lives."
                link="{{ route('index') }}"
                :date="Carbon\Carbon::now()->subDays(5)->setTimezone('America/New_York')"
                isPopular="true"
                isRecommended="true"
            /> --}}
        </div>
    </div>
@endsection