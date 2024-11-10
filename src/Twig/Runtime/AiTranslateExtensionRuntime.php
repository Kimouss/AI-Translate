<?php

namespace App\Twig\Runtime;

use App\Service\TranslationService;
use Twig\Extension\RuntimeExtensionInterface;

class AiTranslateExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private readonly TranslationService $translationService,
    )
    {
    }

    public function aiTranslate(string $value): string
    {
        return $this->translationService->translate($value);
    }
}
