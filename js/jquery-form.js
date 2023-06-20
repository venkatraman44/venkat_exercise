(function ($, Drupal) {
    Drupal.behaviors.venkatExerciseJqueryForm = {
      attach: function (context, settings) {
        var $sameAsPermanent = $('#edit-same-address');
        var $temporaryAddress = $('#edit-local-address');
        var $localAddressWrapper = $('#local-address-wrapper');

        if ($sameAsPermanent.is(':checked')) {
          $temporaryAddress.hide();
          $localAddressWrapper.find('label').hide();
        }

        $sameAsPermanent.on('change', function () {
          if ($(this).is(':checked')) {
            $temporaryAddress.hide();
            $localAddressWrapper.find('label').hide();
          } else {
            $temporaryAddress.show();
            $localAddressWrapper.find('label').show();
          }
        });
      }
    };
  })(jQuery, Drupal);
