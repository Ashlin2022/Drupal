<?php

namespace Drupal\location\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\location\Services\TimeService;

/**
 * Returns Ajax response for Location Ajax route.
 */
class LocationAjaxController extends ControllerBase {

  /**
   * @var $dateTime Drupal\location\Services\TimeService
   */
  protected $dateTime;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('location.time_service'),
      $container->get('renderer')
    );
  }

  /**
   * @param \Drupal\location\Services\TimeService $time  
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer.
   */
  public function __construct(TimeService $date_time, RendererInterface $renderer) {
    $this->dateTime = $date_time;
    $this->renderer = $renderer;
  }

  /**
   * Returns Ajax Response containing the current time.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   Ajax response containing html to render time.
   */
  public function createLocationAjaxResponse(): JsonResponse {
    $currentTime = $this->dateTime->getDateTime();
    $date_time = [
      '#markup' => $currentTime,
    ];

    $response['date_time'] = $this->renderer->render($date_time);
    return new JsonResponse($response);
  }

}
