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
use Throwable;

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
                Heading::resolve([
                    'heading' => $node->textContent,
                    'tag' => $node->nodeName,
                    'withoutFormatting' => $this->withoutFormatting,
                ]),
            );
        } elseif ($node->nodeName === 'pre') {
            try {
                $split = array_map('trim', explode("\n", trim($node->textContent)));
    
                return Blade::renderComponent(
                    Verse::resolve([
                        'text' => $split[0],
                        'reference' => $split[1],
                        'version' => $split[2],
                        'withoutFormatting' => $this->withoutFormatting,
                    ]),
                );
            } catch (Throwable $e) {
                // If error due to bad formatting, continue on and render as simple HTML
            }
        }
        
        // If no special case, return the base HTML
        return $this->dom->saveHTML($node);
    }
}
