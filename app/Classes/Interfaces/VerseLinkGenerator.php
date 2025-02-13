<?php

namespace App\Classes\Interfaces;

interface VerseLinkGenerator
{
    /**
     * Generates a link for the given verse
     *
     * @param string $reference
     * @param string $version
     * @return string
     */
    public function generate(string $reference, string $version): string;
}
