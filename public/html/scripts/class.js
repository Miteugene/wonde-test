const getClassRoute = 'classes';

const classPopup = document.querySelector('.popup');
const studentTemplate = document.querySelector('#student-template').content;
const classTitle = classPopup.querySelector('.popup__title');
const className = classPopup.querySelector('.popup__class-name');
const classStudentList = classPopup.querySelector('.popup__students-list');

classPopup.querySelector('.popup__button-close').addEventListener('click', () => {
  closePopup(classPopup);
});

function openPopup(popup) {
  popup.classList.add('popup_opened');
}

function closePopup(popup) {
  popup.classList.remove('popup_opened');
}

function initPopup(lesson, students)
{
  console.log('initPopup');

  console.log(lesson);
  console.log(students);

  classTitle.textContent = '';
  className.textContent = '';
  classStudentList.textContent = '';

  classTitle.textContent = getDateFrom(lesson.date) + ' ' + lesson.time_start_at + '-' + lesson.time_end_at;
  className.textContent = lesson.class_name;

  for (let i = 0; i < students.length; i++) {
    const student = students[i];

    const studentItem  = studentTemplate.querySelector('.popup__student').cloneNode(true);
    studentItem.textContent = student.forename + ' ' + student.surname;
    classStudentList.append(studentItem);
  }

  openPopup(classPopup);
}

function showClass(lesson) {
  const urlWithParams = `${apiUrl}${getClassRoute}/${lesson.class_id}`;
  console.log(urlWithParams);

  fetchData(urlWithParams, function (responseData) {
    initPopup(lesson, responseData.data);
  });
}
