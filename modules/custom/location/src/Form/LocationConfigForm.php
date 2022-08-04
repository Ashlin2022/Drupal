<?php
/**
 * @file  
 * Contains Drupal\location\Form\LocationConfigForm. 
 */
namespace Drupal\location\Form;
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;
  
class LocationConfigForm extends ConfigFormBase {
  /**  
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'location_config_form';
  }

  /**
   * {@inheritdoc}  
   */
  protected function getEditableConfigNames() {  
    return [  
      'location.adminconfiguration',  
    ];  
  }

  /**  
   * {@inheritdoc}  
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('location.adminconfiguration');  
  
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#description' => $this->t('Enter the country'),
      '#default_value' => $config->get('country'),
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#description' => $this->t('Enter the city'),
      '#default_value' => $config->get('city'),
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#description' => $this->t('Select the timezone'),
      '#required' => TRUE,
      '#options' => [
        'America/Chicago' => t('America/Chicago'),
        'America/New_York' => t('America/New_York'),
        'Asia/Tokyo' => t('Asia/Tokyo'),
        'Asia/Dubai' => t('Asia/Dubai'),
        'Asia/Kolkata' => t('Asia/Kolkata'),
        'Europe/Amsterdam' => t('Europe/Amsterdam'),
        'Europe/Oslo' => t('Europe/Oslo'),
        'Europe/London' => t('Europe/London'),
      ],
      '#default_value' => $config->get('timezone'),
    ];  
  
    return parent::buildForm($form, $form_state);
  }

  /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      $this->config('location.adminconfiguration')
        ->set($key, $value)
        ->save();
    }
    parent::submitForm($form, $form_state);
  }
}
