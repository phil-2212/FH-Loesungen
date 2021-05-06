import { JsonModel } from '../model/JsonModel.js';
import { ListView } from '../view/ListView.js';

class GetController {
  constructor() {
  }

  jsonDataHandle() {

    $.get("https://httpbin.org/get", function(data){

      let outputList = [];

      const model = new JsonModel();
      model.dataEdit(data);

      // pretty sweet, i feel ;-)
      let view = model.allCharacters;

      const outputView = new ListView();
      outputView.setView(view);
      outputView.createTableOutput();
    });
  }
}

export { GetController };
