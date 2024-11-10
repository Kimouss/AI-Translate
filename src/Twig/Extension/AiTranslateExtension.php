<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\AiTranslateExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AiTranslateExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('ai_translate', [AiTranslateExtensionRuntime::class, 'aiTranslate'], ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('ai_translate', [AiTranslateExtensionRuntime::class, 'aiTranslate'], ['is_safe' => ['html']]),
        ];
    }
}
