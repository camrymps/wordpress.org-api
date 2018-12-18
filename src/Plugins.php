<?php

namespace WordPressOrgApi;

trait Plugins {

    /**
     * Returns a list of plugins with their associated information.
     * 
     * @api
     * 
     * @param array $params (optional) Optional parameters: search, browse, tag, 
     * author, page, per_page, fields
     * 
     * @return object
     * 
     */
    public function searchPlugins($params = [])
    {
        return $this->http->makeRequest(
            self::PLUGINS_ENDPOINT,
            array_merge(
                [ 'action' => 'query_plugins' ],
                $params
            )
        );
    }

    /**
     * Asynchronous version of searchPlugins(...) method.
     * 
     * @api
     * 
     * @param array $params (optional) Optional parameters: search, browse, tag, 
     * author, page, per_page, fields
     * 
     * @return object
     * 
     */
    public function searchPluginsAsync($params = [])
    {
        return $this->http->makeAsyncRequest(
            self::PLUGINS_ENDPOINT,
            array_merge(
                [ 'action' => 'query_plugins' ],
                $params
            )
        );
    }

    /**
     * Returns information about a specific plugin.
     * 
     * @api
     * 
     * @param string $slug The slug of the plugin
     * @param array $params (optional) Optional parameter: field 
     * 
     * @return object
     * 
     */
    public function getPlugin($slug, $params = [])
    {
        return $this->http->makeRequest(
            self::PLUGINS_ENDPOINT,
            array_merge(
                [ 'action' => 'plugin_information', 'slug' => $slug ],
                $params
            )
        );
    }

    /**
     * Asynchronous version of getPlugin(...) method.
     * 
     * @api
     * 
     * @param string $slug The slug of the plugin
     * @param array $params (optional) Optional parameter: field 
     * 
     * @return object
     * 
     */
    public function getPluginAsync($slug, $params = [])
    {
        return $this->http->makeAsyncRequest(
            self::PLUGINS_ENDPOINT,
            array_merge(
                [ 'action' => 'plugin_information', 'slug' => $slug ],
                $params
            )
        );
    }

    /**
     * Returns a list of the most popular plugin tags.
     * 
     * @api
     * 
     * @param array $params (optional) Optional parameter: number
     * 
     * @return object
     * 
     */
    public function getHotPluginTags($params = []) 
    {
        return $this->http->makeRequest(
            self::PLUGINS_ENDPOINT,
            array_merge(
                [ 'action' => 'hot_tags' ],
                $params
            )
        );     
    }

    /**
     * Asynchronous version of getHotPluginTags(...) method.
     * 
     * @api
     * 
     * @param array $params (optional) Optional parameter: number
     * 
     * @return object
     * 
     */ 
    public function getHotPluginTagsAsync($params = []) 
    {
        return $this->http->makeAsyncRequest(
            self::PLUGINS_ENDPOINT,
            array_merge(
                [ 'action' => 'hot_tags' ],
                $params
            )
        );     
    }

    /**
     * Returns a list of popular import plugins in the WordPress Plugin Directory.
     * 
     * @api
     * 
     * @return object
     * 
     */
    public function getPopularImportPlugins() 
    {
        return $this->http->makeRequest(self::PLUGIN_IMPORTERS_ENDPOINT);
    }

    /**
     * Asynchronous version of getPopularImportPlugins() method.
     * 
     * @api
     * 
     * @return object
     * 
     */
    public function getPopularImportPluginsAsync() 
    {
        return $this->http->makeAsyncRequest(self::PLUGIN_IMPORTERS_ENDPOINT);
    }
}