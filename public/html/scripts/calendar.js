const getLessonsRoute = 'lessons';

const calendarContainer = document.querySelector('.calendar__container');
const calendarCellTemplate = document.querySelector('#calendar-cell-template').content;

const calendarNavigationWrapper = document.querySelector('.calendar__navigation-wrapper');
const calendarNavigationTemplate = document.querySelector('#calendar-navigation-template').content;

function createCalendarCellHeader(content)
{
  const calendarCellElement  = calendarCellTemplate.querySelector('.calendar__cell').cloneNode(true);
  calendarCellElement.id = 'calendar_' + content;
  calendarCellElement.textContent = content;
  return calendarCellElement;
}

function addCalendarCellHeader(content) {
  const calendarCellElement = createCalendarCellHeader(content);
  calendarContainer.append(calendarCellElement);
}

function addCalendarCell(day, hour) {
  const calendarCellElement = calendarCellTemplate.querySelector('.calendar__cell').cloneNode(true);

  let idx = day + '_' + hour;

  calendarCellElement.id = idx;

  calendarContainer.append(calendarCellElement);

  return idx;
}


function initCalendarDay(dayIndex, lessonsMap, meta) {
  const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
  const startOfWeek = meta.start_of_week;

  addCalendarCellHeader(days[dayIndex] + ' ' + getDateFrom(startOfWeek, dayIndex));

  for (let hour = 8; hour <= 19; hour++) {
    let dayOfWeek = dayIndex + 1;

    let idx = addCalendarCell(dayOfWeek, hour);
    let lesson = lessonsMap[idx];

    if (lesson) {
      addLesson(idx, lesson);
    }
  }
}

function initCalendarNavigationAddWeek(employeeObj, startOfWeek, endOfWeek, addClass)
{
  const calendarNavigationElement = calendarNavigationTemplate.querySelector('.calendar__navigation').cloneNode(true);

  calendarNavigationElement.textContent = getDateFrom(startOfWeek) + '-' + getDateFrom(endOfWeek);

  calendarNavigationElement.addEventListener('click', () => { initCalendarForEmployee(employeeObj, startOfWeek); });

  if (addClass) {
    calendarNavigationElement.classList.add(addClass);
  }

  calendarNavigationWrapper.append(calendarNavigationElement);
}

function initCalendarNavigation(employeeObj, meta) {
  const calendarEmployye = document.querySelector('.calendar__employee');
  calendarEmployye.textContent = employeeObj.forename + ' ' + employeeObj.surname;

  calendarNavigationWrapper.textContent = '';

  initCalendarNavigationAddWeek(employeeObj, meta.prev_start_of_week, meta.prev_end_of_week, 'calendar__navigation_type_prev');
  initCalendarNavigationAddWeek(employeeObj, meta.start_of_week, meta.end_of_week, 'calendar__navigation_type_current');
  initCalendarNavigationAddWeek(employeeObj, meta.next_start_of_week, meta.next_end_of_week, 'calendar__navigation_type_next');
}

function initCalendarDays(lessonsMap, meta) {
  for (let dayIndex = 0; dayIndex < 7; dayIndex++) {
    initCalendarDay(dayIndex, lessonsMap, meta);
  }
}

function initCalendarHeaderTimeLine() {
  for (let hour = 8; hour <= 19; hour++) {
    let hourStr = String(hour).padStart(2, '0');
    addCalendarCellHeader(`${hourStr}:00`);
  }
}

function getLessonsMap(lessons) {
  let lessonsMap = {};

  for (let i = 0; i < lessons.length; i++) {
    const lesson = lessons[i];
    lessonsMap[lesson.day_of_week + '_' + lesson.hour_start] = lesson
  }

  return lessonsMap;
}

function initCalendarForEmployee(employeeObj, date = null) {
  console.log('initCalendarForEmployee');

  let params = {
    employee_id: employeeObj.id
  };

  if (date) {
    params.date = date
  }

  const queryString = new URLSearchParams(params).toString();
  const urlWithParams = `${apiUrl}${getLessonsRoute}?${queryString}`;
  console.log(urlWithParams);

  fetchData(urlWithParams, function (responseData) {
    console.log(responseData);

    calendarContainer.textContent = '';

    addCalendarCellHeader('');
    initCalendarHeaderTimeLine();
    initCalendarDays(
      getLessonsMap(responseData.data), 
      responseData.meta
    );

    initCalendarNavigation(employeeObj, responseData.meta);
  });
}

