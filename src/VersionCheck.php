<?php

namespace camrymps\WordPressOrgApi;

trait VersionCheck {
    
    /**
     * Returns information on currently supported Wordpress versions.
     * 
     * @api
     * 
     * @return object
     * 
     */
    public function checkVersion() 
    {
        return $this->http->makeRequest(self::VERSION_CHECK_ENDPOINT);
    }

    /**
     * Asynchronous version of checkVersion() method.
     * 
     * @api
     * 
     * @return object
     * 
     */
    public function checkVersionAsync()
    {
        return $this->http->makeAsyncRequest(self::VERSION_CHECK_ENDPOINT);
    }

}