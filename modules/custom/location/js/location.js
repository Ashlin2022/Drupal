/**
 * @file
 * Replace date and time.
 */

 (function ($, Drupal) {

  'use strict';
  Drupal.behaviors.locationAjaxGetTime = {
    attach: function () {
      $.ajax({
        url: Drupal.url('location-ajax-response'),
        type: 'POST',
        dataType: 'json',
        success: function (response) {
          if (response.hasOwnProperty('date_time')) {
            $(".location-details .date-time").text(response.date_time);
          }
        }
      });
    }
  };

})(jQuery, Drupal);
