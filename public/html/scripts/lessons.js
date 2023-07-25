
const lessonTemplate = document.querySelector('#lesson-template').content;

function addLesson(idx, lesson)
{
  console.log('addLesson');

  const targetElement = document.getElementById(idx);

  const lessonElement = lessonTemplate.querySelector('.lesson').cloneNode(true);

  lessonElement.style.position = 'relative';
  lessonElement.style.top = lesson.percent_of_hour_start + '%';
  lessonElement.style.left = targetElement.style.left;
  lessonElement.style.height = ((lesson.duration / 60) * 100) + '%';
  lessonElement.style.backgroundColor = `#${lesson.color}`;

  lessonElement.querySelector('.lesson__time').textContent = lesson.time_start_at + '-' + lesson.time_end_at;
  lessonElement.querySelector('.lesson__class-name').textContent = lesson.class_name;

  lessonElement.addEventListener('click', () => { showClass(lesson); });

  targetElement.appendChild(lessonElement);
}
