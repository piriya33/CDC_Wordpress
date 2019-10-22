/**
 * Version: 2.2.0
 */

(function ($) {

  var timeout;
  var delay = 1000;
  var is_blocked = function ($node) {
    return $node.is('.processing') || $node.parents('.processing').length;
  };
  var block = function ($node) {
    if (!is_blocked($node)) {
      $node.addClass('processing').block({
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      });
    }
  };
  var unblock = function ($node) {
    $node.removeClass('processing').unblock();
  };
  $(document).on('click', '.qlwcdc_quick_view', function (e) {
    e.stopPropagation();
    e.preventDefault();
    var product_id = $(this).data('product_id'),
            $modal = $('#qlwcdc_quick_view_modal');
    if (product_id && woocommerce_params.ajax_url) {

      $.ajax({
        type: 'post',
        url: woocommerce_params.ajax_url,
        data: {
          action: 'qlwcdc_quick_view_modal',
          nonce: qlwcdc.nonce,
          product_id: product_id
        },
        complete: function (response) {

          $modal.addClass('opening');
          setTimeout(function () {
            $modal.addClass('open');
            $modal.removeClass('opening');
          }, 50);
        },
        success: function (response) {

          var $response = $(response);
          $response.find('.woocommerce-product-gallery').each(function () {
            $(this).wc_product_gallery();
          });
          $response.on('click', '.close', function (e) {
            $modal.addClass('closing');
            setTimeout(function () {
              $modal.removeClass('open');
              $modal.removeClass('closing');
            }, 600);
          });
          $modal.find('.modal-content').replaceWith($response);
          if (typeof wc_add_to_cart_variation_params !== 'undefined') {
            $modal.find('.variations_form').wc_variation_form();
          }
        }
      });
    }

    return false;
  });

  $('#qlwcdc_quick_view_modal').on('click', function (e) {

    var $context = $(e.target),
            $modal = $(e.delegateTarget);

    if ($context.hasClass('modal-dialog')) {
      $modal.addClass('closing');
      setTimeout(function () {
        $modal.removeClass('open');
        $modal.removeClass('closing');
      }, 600);
    }
  });

  $('form.cart').on('click', '.qlwcdc_quick_purchase', function (e) {
    e.preventDefault();
    e.stopPropagation();

    var $button = $(this),
            $form = $(e.delegateTarget);

    var product_id = $form.find('[name=add-to-cart]').val() || 0,
            variation_id = $form.find('[name=variation_id]').val() || 0,
            quantity = $form.find('[name=quantity]').val() || 1,
            license_key = $form.find('[name=license_key]').val() || 0,
            license_email = $form.find('[name=license_email]').val() || 0,
            license_renewal = $form.find('[name=license_renewal]').val() || 0,
            addons = $form.find('.wc-pao-addon-field').serialize().replace(/\%5B%5D/g, '[]') || 0;

    $button.attr('data-href', function (i, h) {
      if (h.indexOf('?') != -1) {
        $button.attr('data-href', $button.attr('data-href') + '&add-to-cart=' + product_id);
      } else {
        $button.attr('data-href', $button.attr('data-href') + '?add-to-cart=' + product_id);
      }
    });

    if (variation_id) {
      $button.attr('data-href', $button.attr('data-href') + '&variation_id=' + variation_id);
    }

    if (quantity) {
      $button.attr('data-href', $button.attr('data-href') + '&quantity=' + quantity);
    }

    if (addons) {
      $button.attr('data-href', $button.attr('data-href') + '&' + addons);
    }

    if (license_key) {
      $button.attr('data-href', $button.attr('data-href') + '&license_key=' + license_key);
    }

    if (license_email) {
      $button.attr('data-href', $button.attr('data-href') + '&license_email=' + license_email);
    }

    if (license_renewal) {
      $button.attr('data-href', $button.attr('data-href') + '&license_renewal=' + license_renewal);
    }

    if ($button.attr('data-href') != 'undefined') {
      document.location.href = $button.attr('data-href');
    }

    return false;

  });

  /*$(document).on('click', '.single_add_to_cart_button:not(.qlwcdc_quick_purchase):not(.disabled)', function (e) {
   
   if (qlwcdc.add_product_cart !== 'no') {
   
   var $thisbutton = $(this),
   $form = $thisbutton.closest('form.cart'),
   quantity = $form.find('input[name=quantity]').val() || 1,
   product_id = $form.find('input[name=variation_id]').val() || $thisbutton.val();
   
   if (product_id) {
   
   e.preventDefault();
   
   var data = {
   'product_id': product_id,
   'quantity': quantity
   };
   
   $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
   
   $.ajax({
   type: 'POST',
   url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
   data: data,
   beforeSend: function (response) {
   $thisbutton.removeClass('added').addClass('loading');
   },
   complete: function (response) {
   $thisbutton.addClass('added').removeClass('loading');
   },
   success: function (response) {
   
   //if (response.error & response.product_url) {
   //  window.location = response.product_url;
   //  return;
   //}
   
   //console.log('test 2');
   //console.log(data);
   //console.log(response.cart_hash);
   
   $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
   },
   });
   
   return false;
   
   }
   }
   
   });*/

  /*$(document).bind('added_to_cart_message', function (e, cart) {
   
   $.ajax({
   type: 'POST',
   url: woocommerce_params.ajax_url,
   data: {
   action: 'qlwcdc_add_product_cart_ajax_message',
   'queried_object_id': qlwcdc.queried_object_id,
   nonce: qlwcdc.nonce
   },
   beforeSend: function (response) {
   block($('.woocommerce-notices-wrapper:first'));
   },
   complete: function (response) {
   unblock($('.woocommerce-notices-wrapper:first'));
   },
   success: function (response) {
   console.log(response);
   if (response) {
   $('.woocommerce-notices-wrapper:first').replaceWith(response);
   }
   },
   });
   });*/

  $(document).on('keyup', '#qlwcdc_order_coupon_code', function (e) {

    var $form = $(this),
            $coupon = $(this).find('input[name="coupon_code"]'),
            coupon_code = $coupon.val();

    if (timeout) {
      clearTimeout(timeout);
    }

    if (!coupon_code) {
      return;
    }

    timeout = setTimeout(function () {

      if ($form.is('.processing')) {
        return false;
      }

      $form.addClass('processing').block({
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      });

      var data = {
        security: wc_checkout_params.apply_coupon_nonce,
        coupon_code: coupon_code
      };

      $.ajax({
        type: 'POST',
        url: wc_checkout_params.wc_ajax_url.toString().replace('%%endpoint%%', 'apply_coupon'),
        data: data,
        success: function (code) {
          $form.removeClass('processing').unblock();
          if (code) {
            $coupon.before($(code).hide().fadeIn());
            setTimeout(function () {
              $(document.body).trigger('update_checkout', {update_shipping_method: false});
            }, delay * 2);
          }
        },
        dataType: 'html'
      });
      return false;
    }, delay);
  });

  $('#order_review').on('change', 'input.qty', function (e) {
    e.preventDefault();
    var $qty = $(this);
    setTimeout(function () {

      var hash = $qty.attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1"),
              qty = parseFloat($qty.val());
      $.ajax({
        type: 'post',
        url: woocommerce_params.ajax_url,
        data: {
          action: 'qlwcdc_update_cart',
          nonce: qlwcdc.nonce,
          hash: hash,
          quantity: qty
        },
        beforeSend: function (response) {
          block($('#order_review'));
        },
        complete: function (response) {
          unblock($('#order_review'));
        },
        success: function (response) {
          if (response) {
            $('#order_review').html($(response).html()).trigger('updated_checkout');
          }
        },
      });
    }, 400);
  });
  $('#order_review').on('click', 'a.remove', function (e) {
    e.preventDefault();
    var hash = $(this).data('cart_item_key');
    $.ajax({
      type: 'post',
      url: woocommerce_params.ajax_url,
      data: {
        action: 'qlwcdc_update_cart',
        nonce: qlwcdc.nonce,
        quantity: 0,
        hash: hash
      },
      beforeSend: function (response) {
        block($('#order_review'));
      },
      complete: function (response) {
        unblock($('#order_review'));
      },
      success: function (response) {
        if (response) {
          $('#order_review').html($(response).html()).trigger('updated_checkout');
        }
      },
    });
  });
})(jQuery);