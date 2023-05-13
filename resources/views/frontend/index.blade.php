@extends('frontend.layouts.master')

@section('content')
  <div class="container loginHide">
    <div class="w-25 mx-auto mt-5 pt-5 text-center">
        <div class="spinner-border text-primary" role="status">
          </div>
    </div>
  </div>
  <script>
    if (!sessionStorage.getItem('token')) {
        location.href='/login'
    }else{
        loadContent()
       
    }

    
    async function loadContent() {
      let  url='/api/load-content'
        const response = await fetch(url, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        'Authorization':`Bearer ${sessionStorage.getItem('token')}`
                    },
                });
                let html=await response;
                html=await html.text()
        document.querySelector('.loginHide').innerHTML=html

        loadJs()
      }

    
//   {{-- load javascript --}}

function loadJs(){
  const draggables = document.querySelectorAll('.draggableItem')
  const containers = document.querySelectorAll('.draggableContainer')

  draggables.forEach(draggable => {
      draggable.addEventListener('dragstart', (event) => {
          draggable.classList.add('dragging')

      })

      draggable.addEventListener('dragend', () => {
          draggable.classList.remove('dragging')

      })
  })

  containers.forEach(container => {
      container.addEventListener('dragEnter', dragEnterHandler)
      container.addEventListener('drop', dropHandler)
      container.addEventListener('dragover', dragOverHandler)
      container.addEventListener('dragleave', dragLeaveHandler)

  })

  function dragOverHandler(e) {
      e.preventDefault()
  }

  function dragLeaveHandler(e) {
      e.preventDefault()
  }


  function dragEnterHandler(e) {
      e.preventDefault()
  }

  function dropHandler(e) {
      e.preventDefault()
      const draggable = document.querySelector('.dragging')
      const city = document.querySelector('.dragging div span').innerHTML;
      const target = e.target;
      const currentTarget = e.currentTarget;

      // inserting city back to common card 

      if (currentTarget.id == 'common') {
          document.querySelector('.alert').classList.remove('d-block')
         document.querySelector('.alert').classList.add('d-none')
          currentTarget.classList.add('py-5', 'my-5')
          target.prepend(draggable)
          return true;
      }
      // if city belongs to specific country
      if (target.id == draggable.getAttribute('country')) {
          document.querySelector('.alert').classList.remove('d-block')
         document.querySelector('.alert').classList.add('d-none')

      // TODO
      //  we can make here ajax call if want to verify from backend if the data is valdated then only append child to card

          target.appendChild(draggable)
          return true;
      } else {
         document.querySelector('.alert').classList.remove('d-none')
         document.querySelector('.alert').classList.add('d-block')
         document.querySelector('.alert').innerHTML=`${city} doesn't belongs to ${target.id}`

          return false;
      }
  }
}
  </script>

@endsection

