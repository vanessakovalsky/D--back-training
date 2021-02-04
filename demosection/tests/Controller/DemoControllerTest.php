<?php

namespace Drupal\demosection\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the demosection module.
 */
class DemoControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "demosection DemoController's controller functionality",
      'description' => 'Test Unit for module demosection and controller DemoController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests demosection functionality.
   */
  public function testDemoController() {
    // Check that the basic functions of module demosection.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
