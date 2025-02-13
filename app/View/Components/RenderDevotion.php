<?php

namespace App\View\Components;

use App\View\Components\Devotion\Heading;
use App\View\Components\Devotion\Verse;
use Closure;
use DOMDocument;
use DOMNode;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

class RenderDevotion extends Component
{
    /**
     * Array of HTML strings to be output
     *
     * @var array
     */
    public array $nodes = [];

    /**
     * The base DOMDocument instance to use for parsing/rendering
     *
     * @var DOMDocument
     */
    protected DOMDocument $dom;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected readonly string $html,
        public readonly bool $withoutFormatting = false,  
    ) {
        $this->dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $this->dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        // Loop through each top level node in the given html, and output each node's html into
        // the $nodes array
        foreach ($this->dom->getElementsByTagName('body')->item(0)->childNodes as $domNode){
            $this->nodes[] = $this->renderNode($domNode);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.render-devotion');
    }

    /**
     * Render the given DOMNode as HTML
     *
     * @param DOMNode $node
     * @return string
     */
    protected function renderNode(DOMNode $node): string
    {
        if (preg_match('/^h[3-4]$/i', $node->nodeName)) {
            return Blade::renderComponent(
                new Heading($node->textContent, $node->nodeName, $this->withoutFormatting),
            );
        } elseif ($node->nodeName === 'pre') {
            $split = array_map('trim', explode("\n", trim($node->textContent)));

            return Blade::renderComponent(
                (new Verse($split[0], $split[1], $split[2], $split[3], $this->withoutFormatting)),
            );
        }
        
        // If no special case, return the base HTML
        return $this->dom->saveHTML($node);
    }
}
