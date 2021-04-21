class JsonModel {

  constructor() {
    this.allCharacters = [];
  }

  pushToDataList(data) {

    let outputList = [];

    for (let value in data) {

      // TODO: RECURSIVE

      if(typeof data[value] /* !== 'object' */) {
        outputList.push(value);
        outputList.push(data[value]);
      }

    }

    this.outputList = outputList;
  }

  dataEdit(data) {

    for (let [key, value] of Object.entries(data)) {

      if(typeof value === 'object') {
        this.dataEdit(value);
      } else {
        this.allCharacters.push(key);
        this.allCharacters.push(value);
      }

    }
  }

  returnData() {
    return this.outputList;
  }
}

export { JsonModel };
