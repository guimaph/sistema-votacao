function mostrarMensagem(icon, title, text) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text, 
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      })
}