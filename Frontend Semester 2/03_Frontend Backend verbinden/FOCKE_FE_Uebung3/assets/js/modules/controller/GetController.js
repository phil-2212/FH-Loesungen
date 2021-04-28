// TODO: better way of importing and exporting?
import { UserInputController } from '../controller/UserInputController.js';

import { JsonModel } from '../model/JsonModel.js';
import { ListView } from '../view/ListView.js';

class GetController {
  constructor() {
  }

  jsonDataHandle() {

    // TODO: Outsource this method in a better way
    if ($('#list-output').is('.filled')) {
      this.htmlDataRemove();
    }

    const userInput = new UserInputController();
    // Returns all user input choices from input controller
    const parameters = userInput.collectUserInputs();

    $.get(`./assets/php/index.php?${parameters}`, function(data){

      let outputList = [];

      const model = new JsonModel();
      model.dataEdit(data);

      let view = model.allCharacters;

      const outputView = new ListView();
      outputView.setView(view);
      outputView.createTableOutput();
    });
  }

  htmlDataRemove() {
    $("#list-output").empty();
    $("#result-info").empty();
  }
}

export { GetController };
