<script defer>
  const lightMode = document.getElementById('lightmode');
  const darkMode = document.getElementById('darkmode');

  const allElement = document.querySelectorAll('body *');

  if (localStorage.getItem('mode') === null) {
    localStorage.setItem('mode','light')
  }else{
    if (localStorage.getItem('mode') === 'light') {
        lightMode.classList.add('d-none')
        darkMode.classList.remove('d-none')
        allElement.forEach((element)=>{
            element.classList.remove('bg-dark')
            element.classList.remove('text-white')
            element.classList.add('bg-white')
            element.classList.add('text-dark')
        })
    }
    else if (localStorage.getItem('mode') === 'dark'){
        
    lightMode.classList.remove('d-none')
        darkMode.classList.add('d-none')
        allElement.forEach((element)=>{
            element.classList.add('bg-dark')
            element.classList.add('text-white')
            element.classList.remove('bg-white')
            element.classList.remove('text-dark')
        })
    }
  }

  lightMode.addEventListener('click',()=>{
    lightMode.classList.add('d-none')
    darkMode.classList.remove('d-none')

    localStorage.setItem('mode','light')
    allElement.forEach((element)=>{
        element.classList.remove('bg-dark')
        element.classList.remove('text-white')
        element.classList.add('bg-white')
        element.classList.add('text-dark')
    })
  })
  darkMode.addEventListener('click',()=>{

    lightMode.classList.remove('d-none')
    darkMode.classList.add('d-none')

    localStorage.setItem('mode','dark')
    allElement.forEach((element)=>{
        element.classList.add('bg-dark')
        element.classList.add('text-white')
        element.classList.remove('bg-white')
        element.classList.remove('text-dark')
    })
  })

</script>