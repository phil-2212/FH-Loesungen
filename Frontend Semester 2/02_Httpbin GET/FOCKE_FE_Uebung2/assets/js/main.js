import { GetController, JsonModel, ListView } from './config.js';

let listCreateButton = document.querySelector('.listCreateButton');

$(document).ready(function () {

  listCreateButton.addEventListener('click', () => {

    const controller = new GetController();
    controller.jsonDataHandle();

  });

});


// TODO: Ajax extra (?)
// TODO: fillRow Lammer --> outsource this
