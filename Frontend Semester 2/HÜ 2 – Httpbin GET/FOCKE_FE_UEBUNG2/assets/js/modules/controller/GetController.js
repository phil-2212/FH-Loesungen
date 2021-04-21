import { JsonModel } from '../model/JsonModel.js';
import { ListView } from '../view/ListView.js';

class GetController {
  constructor() {
  }

  jsonDataHandle() {

    $.get("https://httpbin.org/get", function(data){

      let outputList = [];

      const model = new JsonModel();
      model.pushToDataList(data);
      model.tryItOut(data);

      let view = model.returnData();

      const outputView = new ListView();
      outputView.setView(view);
      outputView.createTableOutput();
    });
  }
}

export { GetController };
