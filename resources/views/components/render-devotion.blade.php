<div {{ $attributes->merge(['class' => 'rendered-devotion']) }}>
    @foreach ($nodes as $node)
        {!! $node !!}
    @endforeach
</div>
