$(document).ready(function() {
    
    /* Magic Validation */
    /*-----------------------------------------------------*/
    clearError = function(element)
    {
        $(element + ' .form-group').removeClass('has-error');
        $(element + ' .error-message').remove();
    }

    populateError = function(element, data, type = 1) {
        // loop error message
        var focus = "";
        var i = 0;
        $.each(data, function(key, value) {
            // All input by name
            if (key.indexOf('.') >= 0) {
                var xkey = key.split('.');
                var elm = $(element + ' [name="' + xkey[0] + '[]"]').eq(xkey[1]).closest('.form-group');
            } else {
                var elm = $(element + ' [name="' + key + '"]').closest('.form-group');
            }

            $(elm).addClass('has-error');

            // add message to form-group
            if (type == 1) { // yg biasa
                $(elm).append('<span class="error-message help-block">' + value + '</span>');

            } else { // pake tooltips
                $(elm).find('input').prop('title', value);
                $(elm).find('select').prop('title', value);

                $(elm).find('input').tooltip();
                $(elm).find('select').tooltip();
            }

            // get first focus error
            if (i == 0) {
                focus = element + ' [name="' + key + '"]';
            }

            i++;
        });

        // focus element
        $(focus).focus();

        //$.scrollTo('#form-data input[name=name]', 0, {offset: -$(window).height() /2});
    }

    /* preloader */
    showProgressModal = function(element, msg = "Loading...") {
        var loading = `<div class="modal-overlay">
                         <i class="fa fa-3x fa-refresh fa-spin"></i>
                       </div>`;

        // append loading
        $(element).prepend(loading);
    }

    closeProgressModal = function(element) {
        $(element + ' .modal-overlay').remove();
    }

});

$.fn.serializeControls = function() {
  var data = {};

  function buildInputObject(arr, val) {
    if (arr.length < 1)
      return val;    
    var objkey = arr[0];
    if (objkey.slice(-1) == "]") {
      objkey = objkey.slice(0,-1);
    }  
    var result = {};
    if (arr.length == 1) {
      result[objkey] = val;
    } else {
      arr.shift();
      var nestedVal = buildInputObject(arr,val);
      result[objkey] = nestedVal;
    }
    return result;
  }

  $.each(this.serializeArray(), function() {
    var val = this.value;
    var c = this.name.split("[");
    var a = buildInputObject(c, val);
    $.extend(true, data, a);
  });
  
  return data;
}