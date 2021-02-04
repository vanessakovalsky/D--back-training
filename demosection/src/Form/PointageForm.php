<?php

namespace Drupal\demosection\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PointageForm.
 */
class PointageForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pointage_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['projet_imputer'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Projet à imputer'),
      '#weight' => '0',
    ];
    $form['temps_pass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Temps passé'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
      if($key == 'temps_pass'){
        if($value != 'toto') {
          $form_state->setErrorByName('temps_pass', $this->t('Ce champ doit contenir toto'));
        }

      }

    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      if(!is_array($value)){
        \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
      }
    }
  }

}
