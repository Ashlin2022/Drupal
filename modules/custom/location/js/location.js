/**
 * @file
 * Replace date and time.
 */

 (function ($, Drupal, drupalSettings) {

    'use strict';
    var $dateTime = "";

    Drupal.behaviors.locationData = {
      attach: function () {
        $dateTime = $(".location-details").find(".date-time");
        if ($dateTime) {
          $(".location-details .date-time").text(drupalSettings.locationData.date_time);
        }
      }
    };
  
  })(jQuery, Drupal, drupalSettings);
