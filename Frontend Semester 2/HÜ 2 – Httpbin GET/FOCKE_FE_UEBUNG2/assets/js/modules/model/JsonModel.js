class JsonModel {

  constructor() {
  }

  pushToDataList(data) {

    let outputList = [];

    for (let value in data) {

      // TODO: RECURSIVE

      if(typeof data[value] !== 'object') {
        outputList.push(value);
        outputList.push(data[value]);
      } else {
        let newKey = data[value];
        outputList.push(newKey);
        outputList.push(newKey[value]);
      }

    }

    this.outputList = outputList;
  }

  tryItOut(data) {
    console.log(data);
  }

  returnData() {
    return this.outputList;
  }
}

export { JsonModel };
