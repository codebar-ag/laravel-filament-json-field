<?php

namespace CodebarAg\FilamentJsonField\Concerns;

trait HasGutters
{
    public function getGutters(): array
    {
        $gutters = [];

        if ($this->getHasLineNumbers()) {
            $gutters[] = 'CodeMirror-linenumbers';
        }

        if ($this->getHasFoldingCode()) {
            $gutters[] = 'CodeMirror-foldgutter';
        }

        return $gutters;
    }
}
