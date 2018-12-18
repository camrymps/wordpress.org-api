<?php

namespace camrymps\WordPressOrgApi;

interface Endpoints
{
    const VERSION_CHECK_ENDPOINT = 'https://api.wordpress.org/core/version-check/1.7/';
    const THEMES_ENDPOINT = 'https://api.wordpress.org/themes/info/1.1/';
    const PLUGINS_ENDPOINT = 'https://api.wordpress.org/plugins/info/1.1/';
    const PLUGIN_IMPORTERS_ENDPOINT = 'https://api.wordpress.org/core/importers/1.1/';
}