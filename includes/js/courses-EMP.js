var test = document.querySelectorAll('.module');
console.log(test[1]);

for (var i = 0; i < test.length; i++) {
  test[i].addEventListener('click', dropdown, false);
}

function dropdown(){
  var content = this.querySelector('.content');
  var icon = this.querySelector('i');
  if (content.classList.contains('show')) {
    content.classList.remove('show');
    icon.classList.remove('rotated');
  } else {
    content.classList.add('show');
    icon.classList.add('rotated');
  }
}

var videoEmp = document.getElementById('courses-emp-lesson-video');
if(videoEmp){
  var topics = document.getElementById('topic-height');
  var height = videoEmp.offsetHeight;
  topics.style.maxHeight = (height-20)+'px';
  topics.classList.add('overflow-auto', 'border-30px');
}

document.addEventListener("DOMContentLoaded", () => {

  const draggables = document.querySelectorAll('.draggable')
  const containers = document.querySelectorAll('.container')

  draggables.forEach(draggable => {
    draggable.addEventListener('dragstart', () => {
      draggable.classList.add('dragging')
    })
    draggable.addEventListener('touchstart', () => {
      draggable.classList.add('dragging')
    })

    draggable.addEventListener('dragend', () => {
      draggable.classList.remove('dragging');
      orderDraggableElements();
    })
    draggable.addEventListener('touchend', () => {
      draggable.classList.remove('dragging')
    })
  })

  containers.forEach(container => {
    container.addEventListener('dragover', e => {
      e.preventDefault()
      const afterElement = getDragAfterElement(container, e.clientY)
      const draggable = document.querySelector('.dragging')
      if (afterElement == null) {
        container.appendChild(draggable);
      } else {
        container.insertBefore(draggable, afterElement);
      }
    })
  })

  function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')]

    return draggableElements.reduce((closest, child) => {
      const box = child.getBoundingClientRect()
      const offset = y - box.top - box.height / 2
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child }
      } else {
        return closest
      }
    }, { offset: Number.NEGATIVE_INFINITY }).element
  }

  console.log(containers);
  console.log(draggables);

  function orderDraggableElements(){
    var nodes = Array.prototype.slice.call( document.getElementById('list').children );
    var hidden = document.getElementById('lessons_container_position');
    var liRef = document.querySelectorAll('#list .draggable');

    document.getElementById('id')

    var finalData = [];
    for(var i = 0; i < liRef.length; i++){
      liRef[i].dataset.draggableOrder =  parseInt(nodes.indexOf( liRef[i] ));
      finalData[i] = liRef[i].dataset.id;
      console.log(hidden);
    };
    hidden.value = finalData;
  }

});
