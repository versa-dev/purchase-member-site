
function setCenter(className) {
    $('.' + className).css({
        'position': 'absolute',
        'left': '50%',
        'top': '50%',
        'margin-left': -$('.' + className).outerWidth() / 2,
        'margin-top': -$('.' + className).outerHeight() / 2
    });
}

function showLoader() {
    var ajaxLoader = $('<div/>').prop('class', 'ajaxLoader').css('position', 'fixed').html('<img src="http://ds08.projectstatus.co.uk/huntercollectornew/web/images/ajax.gif"/>');
    $('body').append(ajaxLoader);
    setCenter('ajaxLoader');
}

function hideLoader() {
    $('.ajaxLoader').hide();
}

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}