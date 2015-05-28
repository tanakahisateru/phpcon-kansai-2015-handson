
/*
クリック1発でPOSTやPUTなどのリクエストを

Attributes:
data-url required
data-method optional
data-confirm optional

<button data-url="/path/to/action" data-method="DELETE" data-confirm="Are you sure?">Delete</button>

$buttons.singleButtonAction({
    // optional
    prepare: function() {
        return { ... extra params to send };
    }
});
 */

(function() {
  $.fn.singleButtonAction = function(config) {
    return $(this).on('click', function(event) {
      var exec;
      event.preventDefault();
      exec = (function(_this) {
        return function() {
          var data, form, i, k, len, method, url, v;
          url = $(_this).data('url');
          method = $(_this).data('method' != null ? 'method' : 'post');
          data = (config != null ? config.prepare : void 0) != null ? config.prepare.call(_this) : null;
          form = $('<form action="' + url + '">');
          switch (method.toLowerCase()) {
            case 'get':
              form.attr('method', 'get');
              break;
            case 'post':
              form.attr('method', 'post');
              break;
            default:
              form.attr('method', 'post');
              form.append($('<input type="hidden" name="_method">').val(method.toUpperCase()));
          }
          if (data != null) {
            for (v = i = 0, len = data.length; i < len; v = ++i) {
              k = data[v];
              form.append($('<input type="hidden">').attr('name', k).val(v));
            }
          }
          return form.submit();
        };
      })(this);
      if ($(this).data('confirm')) {
        return bootbox.confirm($(this).data('confirm'), function(ok) {
          if (ok) {
            return exec();
          }
        });
      } else {
        return exec();
      }
    });
  };


  /*
  クリック1発でGET以外のリクエストを
  
  Attributes:
  data-url required
  data-method optional
  data-confirm optional
  
  <button data-url="/path/to/action" data-method="DELETE" data-confirm="Are you sure?">Delete</button>
  
  $buttons.singleButtonAjaxAction({
      // optional
      prepare: function() {
          return { ... extra params to send };
      },
      // optional
      done: function(data) {
          // succeeded handler
      },
      // optional
      fail: function() {
          // failed handler
      }
  });
   */

  $.fn.singleButtonAjaxAction = function(config) {
    return $(this).on('click', function(event) {
      var exec;
      event.preventDefault();
      exec = (function(_this) {
        return function() {
          var context, data, method, url;
          url = $(_this).data('url');
          method = $(_this).data('method');
          data = (config != null ? config.prepare : void 0) != null ? config.prepare.call(_this) : null;
          context = {};
          context.type = method != null ? method : 'POST';
          if (data != null) {
            context.data = data;
          }
          return $.ajax(url, context).done(function(data) {
            if (config != null ? config.done : void 0) {
              return config.done.call(_this, data);
            }
          }).fail(function() {
            if (config != null ? config.fail : void 0) {
              return config.fail.call();
            }
          });
        };
      })(this);
      if ($(this).data('confirm')) {
        return bootbox.confirm($(this).data('confirm'), function(ok) {
          if (ok) {
            return exec();
          }
        });
      } else {
        return exec();
      }
    });
  };

}).call(this);

//# sourceMappingURL=single-button-action.js.map