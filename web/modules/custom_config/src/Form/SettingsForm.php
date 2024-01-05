<?php

namespace Drupal\custom_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure custom_config settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_config_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['custom_config.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['sociallinks'] = [
      '#type' => 'details',
      '#title' => $this->t('liens sociaux'),
      '#open' => TRUE,
    ];
    $form['sociallinks'] ['facebook']= [
      '#type' => 'textfield',
      '#title' => $this->t('facebook'),
      '#default_value' => $this->config('custom_config.settings')->get('facebook'),
    ];
    $form['sociallinks'] ['twitter']= [
      '#type' => 'textfield',
      '#title' => $this->t('twitter'),
      '#default_value' => $this->config('custom_config.settings')->get('twitter'),
    ];
    $form['sociallinks'] ['linkedin']= [
      '#type' => 'textfield',
      '#title' => $this->t('linkedin'),
      '#default_value' => $this->config('custom_config.settings')->get('linkedin'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // valider les valeurs de formulaire
    // il faut qu’il s’agisse de liens.
    $facebook = $form_state->getValue('facebook');
    $twitter = $form_state->getValue('twitter');
    $linkedin = $form_state->getValue('linkedin');
    if (!filter_var($facebook, FILTER_VALIDATE_URL)) {
      $form_state->setErrorByName('facebook', $this->t("le lien de facebook n'est pas valide"));
    }
    if (!filter_var($twitter, FILTER_VALIDATE_URL)) {
      $form_state->setErrorByName('twitter', $this->t("le lien de twitter n'est pas valide"));
    }
    if (!filter_var($linkedin, FILTER_VALIDATE_URL)) {
      $form_state->setErrorByName('linkedin', $this->t("le lien de linkedin n'est pas valide"));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('custom_config.settings')
      ->set('facebook', $form_state->getValue('facebook'))
      ->set('twitter', $form_state->getValue('twitter'))
      ->set('linkedin', $form_state->getValue('linkedin'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
