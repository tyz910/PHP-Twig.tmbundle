<?php

$mapping = [
    '{{' => '[[',
    '}}' => ']]',
    '{%' => '[%',
    '%}' => '%]',
    '{#' => '[#',
    '#}' => '#]',
];

convert(__DIR__ . '/Preferences', $mapping);
convert(__DIR__ . '/Snippets', $mapping);
convert(__DIR__ . '/Syntaxes', $mapping);

function convert($dir, $mapping)
{
    foreach (new DirectoryIterator($dir) as $fileInfo) {
        if ($fileInfo->isFile()) {
            $content = file_get_contents($fileInfo->getPathname());
            $content = str_replace(
                array_map('preg_quote', array_keys($mapping)),
                array_map('preg_quote', array_values($mapping)),
                $content
            );
            $content = str_replace(
                array_keys($mapping),
                array_values($mapping),
                $content
            );
            file_put_contents($fileInfo->getPathname(), $content);
        }
    }
}
