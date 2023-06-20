(function ($, Drupal) {
  $(document).ready(function () {
    var $sameAsPermanent = $('#edit-same-address');
    var $temporaryAddress = $('#edit-local-address');
    var $localAddressLabel = $('#local-address-wrapper label');

    $temporaryAddress.toggle(!$sameAsPermanent.is(':checked'));
    $localAddressLabel.toggle(!$sameAsPermanent.is(':checked'));

    $sameAsPermanent.on('change', function () {
      $temporaryAddress.toggle(!$(this).is(':checked'));
      $localAddressLabel.toggle(!$(this).is(':checked'));
    });
  });
})(jQuery, Drupal);
