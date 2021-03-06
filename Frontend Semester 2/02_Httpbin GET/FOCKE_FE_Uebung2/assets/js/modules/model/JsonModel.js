class JsonModel {

  constructor() {
    this.allCharacters = [];
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
