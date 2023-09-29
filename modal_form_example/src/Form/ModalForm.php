<?php

namespace Drupal\modal_form_example\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseDialogCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Modal form example form.
 */
class ModalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'modal_form_example_modal';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $field = NULL) {

    /**
     *
     * Adelaide Photo by <a href="https://unsplash.com/@kina020?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Kina</a> on <a href="https://unsplash.com/photos/vIYzKdPJN6M?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
     * Belfast Photo by <a href="https://unsplash.com/@pixelatelier?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Christian Holzinger</a> on <a href="https://unsplash.com/photos/FAp9dl6bNWk?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
     * Chicago Photo by <a href="https://unsplash.com/@kriztheman?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Christopher Alvarenga</a> on <a href="https://unsplash.com/photos/cfmSStcrDn4?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
     * Dubai Photo by <a href="https://unsplash.com/@zqlee?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">ZQ Lee</a> on <a href="https://unsplash.com/photos/DcyL0IoCY0A?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
     *
     */

    // Stores the ID of the field on the parent form for us to insert the selected radio value into.
    $form['field'] = [
      '#type' => 'hidden',
      '#value' => $field,
    ];

    $form['office'] = [
      '#type' => 'radios',
      '#default_value' => 'Belfast',
      '#options' => [
        'Adelaide - Australia' => 'Adelaide',
        'Belfast - Northern Ireland' => 'Belfast',
        'Chicago - United States' => 'Chicago',
        'Dubai - United Arab Emirates' => 'Dubai',
      ],
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Select'),
      '#ajax' => [
        'callback' => [$this, 'submitForm'],
        'event' => 'click',
      ],
    ];

    $form['#attached']['library'][] = 'modal_form_example/modal_form_example';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Calls the javascript callback function passing in our form values.
    $response = new AjaxResponse();
    $response->addCommand(new InvokeCommand(NULL, 'modalFormAjaxCallback', [
      $form_state->getValue('field'),
      $form_state->getValue('office')
    ]));
    $response->addCommand(new CloseDialogCommand());

    return $response;
  }

}
