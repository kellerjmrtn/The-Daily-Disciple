<?php

namespace App\Classes\Verse;

use App\Classes\Interfaces\VerseLinkGenerator;

class BibleGatewayGenerator implements VerseLinkGenerator
{
    /**
     * Generates a Bible Gateway link for the given verse
     *
     * @param string $reference
     * @param string $version
     * @return string
     */
    public function generate(string $reference, string $version): string
    {
        $query = http_build_query([
            'search' => $reference,
            'version' => $version,
        ]);

        return "https://www.biblegateway.com/passage/?$query";
    }
}
