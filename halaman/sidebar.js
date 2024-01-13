function menuBtn() {

    const menuBtn =document.querySelector('.menu')

    menuBtn.classList.toggle('active')

    const sidebar = document.querySelector('aside')
    const header =document.querySelector('header')
    const layout =document.querySelector('.layout')
    const menuTittle =document.querySelectorAll('#menuTittle')
    const menuActive =document.querySelectorAll('.menu-active')
    const menuNonActive =document.querySelectorAll('.menu-nonactive')
    if(menuBtn.classList.contains('active')) {

        if(window.innerWidth > 768) {
            if(!header.classList.contains('static')) { header.style.paddingLeft = '250px' }
            layout.style.paddingLeft = '250px'
        }
        sidebar.style.width = '250px'
        menuTittle.forEach((e) => {
            e.style.display = 'block'
        })
        menuActive.forEach((e) => {
            e.style.justifyContent = 'start'
        })
        menuNonActive.forEach((e) => {
            e.style.justifyContent = 'start'
        })
    } else {
        sidebar.style.width = ''
        if(!header.classList.contains('static')) { header.style.paddingLeft = '' }
        layout.style.paddingLeft = ''
        menuTittle.forEach((e) => {
            e.style.display = 'none'
        })
        menuActive.forEach((e) => {
            e.style.justifyContent = ''
        })
        menuNonActive.forEach((e) => {
            e.style.justifyContent = ''
        })

    }
}