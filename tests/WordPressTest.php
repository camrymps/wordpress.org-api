<?php 

use PHPUnit\Framework\TestCase;
use camrymps\WordPressOrgApi\Wordpress as WordPressClient;

/**
* Class for testing WordPress class.
*
* @author Michael Scott
* 
*/
class WordPressTest extends TestCase
{

  /**
   * @test
   */
  public function canDecodeAResponseAsAssociativeArray()
  {
    $client = new WordPressClient(true);

    $response = $client->searchThemes();

    $this->assertTrue(is_array($response));
  }

  /** 
   * THEME TESTS 
   */

  /**
   * @test
   */
  public function canSearchThemes() 
  {
    $client = new WordPressClient;

    $response = $client->searchThemes();

    $this->assertObjectHasAttribute('themes', $response);
    $this->assertGreaterThan(0, count($response->themes));

    unset($response);
    unset($client);
  }

  /**
   * @test
   */
  public function canSearchThemesAsynchronously()
  {
    $client = new WordPressClient;

    $promise = $client->searchThemesAsync();
    $response = $promise->wait();

    $this->assertObjectHasAttribute('themes', $response);
    $this->assertGreaterThan(0, count($response->themes));

    unset($promise);
    unset($response);
    unset($client);
  }

  /**
   * @test
   */
  public function canSearchThemesWithParameters() 
  {
    $client = new WordPressClient;

    $response = $client->searchThemes([ 'per_page' => 30 ]);

    $this->assertObjectHasAttribute('themes', $response);
    $this->assertCount(30, $response->themes);

    unset($response);
    unset($client);
  }

  /**
   * @test
   */
  public function canGetTheme() 
  {
    $client = new WordPressClient;

    $this->assertEquals('Twenty Seventeen', $client->getTheme('twentyseventeen')->name);

    unset($client);
  }

  /**
   * @test
   */
  public function canGetThemeAsynchronously() 
  {
    $client = new WordPressClient;

    $promise = $client->getThemeAsync('twentyseventeen');

    $this->assertTrue($promise->wait()->name === 'Twenty Seventeen');

    unset($promise);
    unset($client);
  }

  /**
   * @test
   */
  public function cannotGetThemeFromEmptySlug() 
  {
    $client = new WordPressClient;

    $this->expectException(ArgumentCountError::class);

    $client->getTheme();

    unset($client);
  }

  /**
   * @test
   */
  public function cannotGetThemeFromInvalidSlug()
  {
    $client = new WordPressClient;

    $response = $client->getTheme('foo_bar');

    $this->assertObjectHasAttribute('error', $response);
    $this->assertEquals('Bad request.', $response->error);

    unset($response);
    unset($client);
  }

  /**
   * @test
   */
  public function canGetThemeFeatureList()
  {
    $client = new WordpressClient;

    $this->assertTrue(!isset($client->getThemeFeatureList()->error));

    unset($client);
  }

  /**
   * @test
   */
  public function canGetThemeFeatureListAsync()
  {
    $client = new WordpressClient;

    $promise = $client->getThemeFeatureListAsync();

    $this->assertTrue(!isset($promise->wait()->error));

    unset($promise);
    unset($client);
  }


  /** 
   * PLUGIN TESTS 
   */

  /**
   * @test
   */
  public function canSearchPlugins() 
  {
    $client = new WordPressClient;

    $response = $client->searchPlugins();

    $this->assertObjectHasAttribute('plugins', $response);
    $this->assertGreaterThan(0, count($response->plugins));

    unset($response);
    unset($client);
  }

  /**
   * @test
   */
  public function canSearchPluginsAsynchronously()
  {
    $client = new WordPressClient;

    $promise = $client->searchPluginsAsync();
    $response = $promise->wait();

    $this->assertObjectHasAttribute('plugins', $response);
    $this->assertGreaterThan(0, count($response->plugins));

    unset($promise);
    unset($response);
    unset($client);   
  }

  /**
   * @test
   */
  public function canSearchPluginsWithParameters()
  {
    $client = new WordPressClient;

    $response = $client->searchPlugins([ 'per_page' => 30 ]);

    $this->assertObjectHasAttribute('plugins', $response);
    $this->assertCount(30, $response->plugins);

    unset($response);
    unset($client);    
  }

  /**
   * @test
   */
  public function canGetPlugin()
  {
    $client = new WordPressClient;

    $this->assertEquals('Jetpack by WordPress.com', $client->getPlugin('jetpack')->name);

    unset($client);
  }

  /**
   * @test
   */
  public function canGetPluginAsynchronously()
  {
    $client = new WordPressClient;

    $promise = $client->getPluginAsync('jetpack');

    $this->assertTrue($promise->wait()->name === 'Jetpack by WordPress.com');

    unset($promise);
    unset($client);   
  }

  /**
   * @test
   */
  public function cannotGetPluginFromEmptySlug()
  {
    $client = new WordPressClient;

    $this->expectException(ArgumentCountError::class);

    $client->getPlugin();

    unset($client);
  }

  /**
   * @test
   */
  public function cannotGetPluginFromInvalidSlug()
  {
    $client = new WordPressClient;

    $response = $client->getPlugin('foo_bar');

    $this->assertObjectHasAttribute('error', $response);
    $this->assertEquals('Bad request.', $response->error);

    unset($response);
    unset($client);
  }

  /**
   * @test
   */
  public function canGetHotPluginTags()
  {
    $client = new WordPressClient;

    $this->assertTrue(!isset($client->getHotPluginTags()->error));

    unset($client);
  }

  /**
   * @test
   */
  public function canGetHotPluginTagsAsynchronously()
  {
    $client = new WordPressClient;

    $promise = $client->getHotPluginTagsAsync();

    $this->assertTrue(!isset($promise->wait()->error));

    unset($promise);
    unset($client);   
  }

  /**
   * @test
   */
  public function canGetPopularImportPlugins()
  {
    $client = new WordPressClient;

    $this->assertObjectHasAttribute('importers', $client->getPopularImportPlugins());

    unset($client);
  }

  /**
   * @test
   */
  public function canGetPopularImportPluginsAsynchronously()
  {
    $client = new WordPressClient;

    $promise = $client->getPopularImportPluginsAsync();

    $this->assertObjectHasAttribute('importers', $promise->wait());

    unset($promise);
    unset($client);   
  }


  /** 
   * VERSION CHECK TESTS 
   */

  /**
   * @test
   */
  public function canCheckVersion()
  {
    $client = new WordPressClient;

    $this->assertObjectHasAttribute('offers', $client->checkVersion());

    unset($client);
  }

  /**
   * @test
   */
  public function canCheckVersionAsynchronously()
  {
    $client = new WordPressClient;

    $promise = $client->checkVersionAsync();

    $this->assertObjectHasAttribute('offers', $promise->wait());

    unset($promise);
    unset($client);
  }

}
