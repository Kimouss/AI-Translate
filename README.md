# Symfony - Docker
This project will init a Symfony project with Docker

## Requirements
- Docker
- Docker-compose
- Make

## Installation
- ``make install`` or ``make reset`` :)
- ``git clone https://huggingface.co/Xenova/nllb-200-distilled-600M models``
  - By default, I used this model

# Using Twig for Translation in Symfony

This project includes a custom translation system to automatically translate strings in Twig templates based on the user’s locale. With the `TranslationService`, text can be translated automatically according to the user’s language and is cached in the session for better performance.

## Features

- **Automatic String Translation**: Strings are translated using a transformer-based translation API.
- **Session Cache**: Translations are stored in the user’s session to avoid repetitive translations.
- **Locale Detection**: The user’s locale is automatically detected from the current request.

## Usage

To use translation in your Twig templates, simply apply the `|ai_translate` filter to any string you want to translate.

### Example Usage in a Twig Template

In your Twig file, apply the `|ai_translate` filter to strings:

```twig
{% extends 'base.html.twig' %}

{% block title %}Hello PageController!{% endblock %}

{% block body %}
<div class="example-wrapper">
    <h1>{{ 'Hello' | ai_translate }} {{ controller_name }}! ✅</h1>
    <p>{{ 'i am a test' | ai_translate }}</p>
    <p>{{ 'i am another test' | ai_translate }}</p>

    {{ 'This friendly message is coming from:' | ai_translate }}
    <ul>
        <li>{{ 'Your controller at' | ai_translate }} <code>/var/www/app/src/Controller/PageController.php</code></li>
        <li>{{ 'Your template at' | ai_translate }} <code>/var/www/app/templates/page/index.html.twig</code></li>
    </ul>
</div>
{% endblock %}
