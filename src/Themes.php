<?php

namespace camrymps\WordPressOrgApi;

trait Themes {

    /**
     * Returns a list of themes with their associated information.
     * 
     * @api
     * 
     * @param array $params (optional) Optional parameters: search, tag, theme, author, 
     * page, per_page, browse, fields
     * 
     * @return object
     * 
     */
    public function searchThemes($params = []) 
    {
        return $this->http->makeRequest(
            self::THEMES_ENDPOINT, 
            array_merge(
                [ 'action' => 'query_themes' ],
                $params
            )
        );
    }

    /**
     * Asynchronous version of searchThemes(...) method.
     * 
     * @api
     * 
     * @param array $params (optional) Optional parameters: search, tag, theme, author, 
     * page, per_page, browse, fields
     * 
     * @return object
     * 
     */        
    public function searchThemesAsync($params = [])
    {
        return $this->http->makeAsyncRequest(
            self::THEMES_ENDPOINT,
            array_merge(
                [ 'action' => 'query_themes' ],
                $params
            )
        );
    }

    /**
     * Returns information about a specific theme.
     * 
     * @api
     * 
     * @param string $slug Slug of a specific theme to return
     * @param array $params (optional) Optional parameter: fields
     * 
     * @return object
     * 
     */
    public function getTheme($slug, $params = []) 
    {
        return $this->http->makeRequest(
            self::THEMES_ENDPOINT,
            array_merge(
                [ 'action' => 'theme_information', 'slug' => $slug ],
                $params
            )
        );
    }

    /**
     * Asynchronous version of getTheme(...) method.
     * 
     * @api
     * 
     * @param string $slug Slug of a specific theme to return
     * @param array $params (optional) Optional parameter: fields
     * 
     * @return object
     * 
     */
    public function getThemeAsync($slug, $params = []) 
    {
        return $this->http->makeAsyncRequest(
            self::THEMES_ENDPOINT,
            array_merge(
                [ 'action' => 'theme_information', 'slug' => $slug ],
                $params                
            )
        );
    }

    /**
     * Returns a list of the most popular theme tags.
     * 
     * @api
     * 
     * @param array $params (optional) Optional parameters: number
     * 
     * @return object
     * 
     */
    public function getHotThemeTags($params = [])
    {
        return $this->http->makeRequest(
            self::THEMES_ENDPOINT,
            array_merge(
                [ 'action' => 'hot_tags' ],
                $params
            )
        );
    }
    
    /**
     * Asynchronous version of getHotThemeTags(...) method.
     * 
     * @api
     * 
     * @param array $params (optional) Optional parameters: number
     * 
     * @return object
     * 
     */
    public function getHotThemeTagsAsync($params = [])
    {
        return $this->http->makeAsyncRequest(
            self::THEMES_ENDPOINT,
            array_merge(
                [ 'action' => 'hot_tags' ],
                $params
            )
        );
    }

    /**
     * Returns a list of valid theme tags.
     * 
     * @api
     * 
     * @return object
     * 
     */
    public function getThemeFeatureList() 
    {
        return $this->http->makeRequest(
            self::THEMES_ENDPOINT,
            [ 'action' => 'feature_list' ]
        );
    }
    
    /**
     * Asynchronous version of getThemeFeatureList() method.
     * 
     * @api
     * 
     * @return object
     * 
     */
    public function getThemeFeatureListAsync()
    {
        return $this->http->makeAsyncRequest(
            self::THEMES_ENDPOINT,
            [ 'action' => 'feature_list' ]
        );
    }

}

