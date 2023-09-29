<?php

namespace Drupal\modal_form_example\Form;

use Drupal\Component\Serialization\Json;
use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a Modal form example form.
 */
class ModalParentForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'modal_form_example_modal_parent';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $office_field_id = Html::getUniqueId('office-select');

    $form['office'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Office'),
      '#required' => TRUE,
      '#disabled' => TRUE,
      '#attributes' => [
        'id' => $office_field_id,
      ],
    ];

    // Affix the topic tree link to the field.
    $form['office']['#field_prefix'] = [
      '#title' => $this->t('Select office'),
      '#type' => 'link',
      '#url' => Url::fromRoute('modal_form_example.modal_form', [
        'field' => $office_field_id,
      ]),
      '#attributes' => [
        'class' => ['button', 'use-ajax'],
        'data-dialog-type' => 'modal',
        'data-dialog-options' => Json::encode([
          'title' => $this->t('Select office to contact'),
          'width' => 700,
          'height' => 500,
        ]),
      ],
    ];


    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];

    $form['#attached']['drupalSettings'] = [
      'modal_form_example.field' => $office_field_id,
    ];

    $form['#attached']['library'][] = 'modal_form_example/modal_form_example';

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    $form_state->setRedirect('<front>');
  }

}
