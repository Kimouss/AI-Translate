<?php

namespace App\Service;

use Codewithkyrian\Transformers\Transformers;
use Symfony\Component\HttpFoundation\RequestStack;
use function Codewithkyrian\Transformers\Pipelines\pipeline;

class TranslationService
{
    public function __construct(
        private readonly RequestStack $requestStack,
    )
    {
    }

    public function translate(string $string): string
    {
        $session = $this->requestStack->getSession();
        $keyTranslation = $this->keyTranslation($string);
        if ($this->hasSessionTranslation($string)) {
            return $session->get($keyTranslation);
        }

        Transformers::setup()->setCacheDir('../models')->apply();
        $pipe = pipeline('translation', 'Xenova/nllb-200-distilled-600M');
        $output = $pipe(
            $string,
            maxNewTokens: 256,
            tgtLang: $this->getLocaleLang()
        );
        $translated = trim($output[0]['translation_text']);
        $session->set($keyTranslation, $translated);

        return $translated;
    }

    private function getCurrentLocale(): ?string
    {
        $request = $this->requestStack->getCurrentRequest();

        return $request ? $request->getLocale() : 'fr';
    }

    private function getLocaleLang(): string
    {
        $array = [
            'fr' => 'fra_Latn',
            'en' => 'eng_Latn',
            'de' => 'deu_Latn',
            'es' => 'spa_Latn',
        ];

        return $array[$this->getCurrentLocale()];
    }

    private function keyTranslation(string $string): string
    {
        return sprintf('%s_%s', $this->getLocaleLang(), $string);
    }

    private function hasSessionTranslation(string $string): bool
    {
        return $this->requestStack->getSession()->has($this->keyTranslation($string));
    }
}