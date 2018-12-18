<?php 

namespace WordPressOrgApi;

/**
*  Class for retrieving information from the WordPress.org API.
*
*  @author Michael Scott
*
*/
final class WordPress implements Endpoints
{
    private $http;

    public function __construct($return_assoc = false) {
        $this->http = new HttpClient($return_assoc);
    }

    use VersionCheck;
    use Themes;
    use Plugins;
}