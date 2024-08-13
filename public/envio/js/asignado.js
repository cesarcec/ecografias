
const asignado = document.querySelectorAll('.entregar');

asignado.forEach(elemento => {
    elemento.addEventListener('click', entregar);
});
//llol

function entregar(e){
    const btn = e.target;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${URL_WEB}envio-resultado/entregar`, {
        method: 'POST',
        body: JSON.stringify({id_envio: btn.getAttribute('data-id-envio')}),
        headers: {
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': csrfToken
        }
    }).then(response => {
        console.log('Respuesta del servidor:', response);
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.status);
        }
        return response.json();}
    ).then(data => {
        console.log(data);
        if(data.success){
            Swal.fire({
                title: "Exito!",
                text: "Entregado correctamente!",
                icon: "success",
            }).then((result) => {
                // El código dentro de este bloque se ejecutará después de que el usuario hace clic en "Aceptar"
                if (result.isConfirmed) {
                    // Coloca aquí el código que deseas ejecutar después de hacer clic en "Aceptar"
                    console.log("Se hizo clic en Aceptar");                                   
                    window.location.reload();
                }
            });
            
        }
    })
    .catch(error => console.error('Error de la solicitud', error));
}