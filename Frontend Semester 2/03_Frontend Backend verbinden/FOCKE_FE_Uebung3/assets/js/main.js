import { GetRequestController } from './modules/controller/GetRequestController.js';

// TODO: Place it somehwere else – where does it make sense?
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});

$(document).ready(function () {
  $('form').submit(function (event) {
    const formData = {
      loopType: $('#loopType').val(),
      until: $('#until').val(),
    };

    $.ajax({
      type: 'POST',
      url: './assets/php/controller/UserInputController.php',
      data: formData,
    }).done(function (data) {

      $('#result-info').append(`${data}`);

      const controller = new GetRequestController();
      controller.jsonDataHandle();
    });

    event.preventDefault();
  });
});
