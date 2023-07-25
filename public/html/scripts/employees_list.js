const getEmployeesRoute = 'employees';


const employeesContainer = document.querySelector('.employees__list');
const employeesTemplate = document.querySelector('#cards-template').content;

function createEmployee(employeeObj) {
  const employeeElement  = employeesTemplate.querySelector('.cards__item').cloneNode(true);

  const fullname = employeeObj.forename + ' ' + employeeObj.surname;

  const employeesImage = employeeElement.querySelector('.cards__image');
  //employeesImage.src = './images/user.png';
  employeesImage.alt = fullname;

  employeeElement.querySelector('.cards__title').textContent = employeeObj.title;
  employeeElement.querySelector('.cards__name').textContent = fullname;
  employeeElement.id = employeeObj.id;

  employeeElement.addEventListener('click', () => {
    initCalendarForEmployee(employeeObj, '2023-07-17');
  });

  return employeeElement;
}

function addEmployee(employeeObj) {
  const employeeElement = createEmployee(employeeObj);
  employeesContainer.append(employeeElement);
}

function initEmployees(initialCards) {
  console.log('initEmployees');
  initialCards.forEach(employeeObj => {
    addEmployee(employeeObj);
  });

  initCalendarForEmployee(initialCards[0], '2023-07-17');
}

fetchData(apiUrl + getEmployeesRoute, function (responseData) {
  initEmployees(responseData.data);
});
