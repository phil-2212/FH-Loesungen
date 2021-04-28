import { GetController, JsonModel, ListView } from './config.js';

let listCreateButton = document.querySelector('.listCreateButton');

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

$(document).ready(function () {

  listCreateButton.addEventListener('click', () => {

    const controller = new GetController();
    controller.jsonDataHandle();

  });

});
