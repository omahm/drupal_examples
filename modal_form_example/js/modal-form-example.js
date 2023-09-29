/**
 * @file
 * Modal form example.
 */

(function($, Drupal, drupalSettings) {
  Drupal.behaviors.topicTree = {
    attach: function(context, settings) {
      let field = drupalSettings['modal_form_example.field'];
      let selected = $('#' + field).val();

      if (selected) {
        $("input[value='" + selected + "']").prop('checked', true);
      }
    }
  }
})(jQuery, Drupal, drupalSettings);

/**
 * Callback for the Topic Tree form submit.
 */
(function($) {
  $.fn.modalFormAjaxCallback = function(field, message) {
    console.log(field);
    console.log(message);
    // Reset all checkboxes before updating with the tree values.
    $('#' + field).val(message);

  };
})(jQuery);

