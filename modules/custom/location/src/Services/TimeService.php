<?php
/**
 * @file  
 * Contains Drupal\location\Services\TimeService. 
 */
namespace Drupal\location\Services;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Datetime\DateFormatter;

/**
 * Class TimeService
 * @package Drupal\location\Services
 */
class TimeService {
  /**
   * @var $config_factory \Drupal\Core\Config\ConfigFactory
   */
  protected $config_factory;

  /**
   * @var $date_formatter Drupal\Core\Datetime\DateFormatter
   */
  protected $date_formatter;

  /**
   * TimeService constructor.
   * @param ConfigFactory $config_factory
   * @param DateFormatter $date_formatter
   */
  public function __construct(ConfigFactory $config_factory, DateFormatter $date_formatter) {
    $this->config_factory = $config_factory;
    $this->date_formatter = $date_formatter;
  }

  /**
   * @return $date_time
   */
  public function getDateTime() {
    $timezone = $this->config_factory->get('location.adminconfiguration')->get('timezone');
    $current_time = time();
    $date_time = $this->date_formatter->format($current_time, 'custom', 'jS M Y h:i A', $timezone);
    return $date_time;
  }
}
