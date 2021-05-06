class InputParameterController {
  constructor() {
    this.getParameters = [];
  }

  collectUserInputs () {
    const userInputs = document.querySelectorAll('.getValue'); /* maybe serialize? */

    for (let i = 0; i < userInputs.length; i++) {
      this.getParameters.push(`${userInputs[i].id}=${userInputs[i].value}`);
    }

    /* This returns php-ready parameters. But it makes error handling diifcult... */
    return (this.getParameters.join('&'));
  }
}

export { InputParameterController };
