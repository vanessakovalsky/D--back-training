<?php

namespace Drupal\demosection\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class DemoController.
 */
class DemoController extends ControllerBase {

  /**
   * Demopage.
   *
   * @return string
   *   Return Hello string.
   */
  public function demoPage() {
    $client = \Drupal::httpClient();
    $json_data = $client->request('GET','https://virtserver.swaggerhub.com/vanessakovalsky/BoardGames/1.0.0/boardgame/findByStatus?status=sold');
    $data = json_decode($json_data->getBody());
    
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Nom du jeu '.$data[0]->name)
    ];
  }

}
