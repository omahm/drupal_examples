<?php

namespace Drupal\modal_form_example\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for modal_form_example routes.
 */
class ModalFormExampleController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
