import { InputParameterController } from '../controller/InputParameterController.js';
import { JsonModel } from '../model/JsonModel.js';
import { ListView } from '../view/ListView.js';

class GetRequestController {

  jsonDataHandle() {
    const userInput = new InputParameterController();
    const parameters = userInput.collectUserInputs();

    $.get(`./assets/php/index.php?${parameters}`, function (data) {

      const model = new JsonModel();
      model.dataEdit(data);

      const view = model.allCharacters;

      const outputView = new ListView();
      outputView.setView(view);
      outputView.createTableOutput();
    });
  }
}

export { GetRequestController };
