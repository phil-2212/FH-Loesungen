import { GetController, JsonModel, ListView } from './config.js';

// TODO: Place it somehwere else – where does it make sense?
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});

const listCreateButton = document.querySelector('.listCreateButton');

$(document).ready(function () {

  listCreateButton.addEventListener('click', () => {

    const controller = new GetController();
    controller.jsonDataHandle();

  });

});

// TODO: .mjs implementation
