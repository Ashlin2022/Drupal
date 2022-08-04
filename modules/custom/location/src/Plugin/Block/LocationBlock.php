<?php

namespace Drupal\location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\location\Services\TimeService;

/**
 * Provides a 'Location' Block.
 *
 * @Block(
 *   id = "location_block",
 *   admin_label = @Translation("Location block"),
 *   category = @Translation("Location details"),
 * )
 */
class LocationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var $configFactory \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * @var $dateTime Drupal\location\Services\TimeService
   */
  protected $dateTime;

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory'),
      $container->get('location.time_service')
    );
  }

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\location\Services\TimeService $time
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, 
  ConfigFactoryInterface $config_factory, TimeService $date_time) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $config_factory;
    $this->dateTime = $date_time;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $date_time = $this->dateTime->getDateTime();
    $country = $this->configFactory->get('location.adminconfiguration')->get('country');
    $city = $this->configFactory->get('location.adminconfiguration')->get('city');
    $build = [
      '#theme' => 'location_block',
      '#country' =>  $country,
      '#city'  =>  $city,
      '#date_time' => $date_time,
      '#attached' => [
        'drupalSettings' => [
          'locationData' => [
            'country' => $country,
            'city'=> $city,
            'date_time' => $date_time,
          ],
        ],
        'library' => [
          'location/location',
        ],
      ],
    ];
    return $build;
  }

}
