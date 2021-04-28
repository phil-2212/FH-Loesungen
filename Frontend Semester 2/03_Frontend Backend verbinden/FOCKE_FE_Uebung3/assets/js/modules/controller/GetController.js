import { UserInputController } from '../controller/UserInputController.js';
import { JsonModel } from '../model/JsonModel.js';
import { ListView } from '../view/ListView.js';

class GetController {

  jsonDataHandle() {
    const userInput = new UserInputController(); /* not sure if this is a good solution */

    const parameters = userInput.collectUserInputs();

    $.get(`./assets/php/index.php?${parameters}`, function (data) {

      const outputView = new ListView(); /* TODO: instantiate here, use down there again? */
      outputView.prepareOutputField();

      const model = new JsonModel();
      model.dataEdit(data);

      const view = model.allCharacters;

      outputView.setView(view);
      outputView.createTableOutput();
    });
  }
}

export { GetController };
