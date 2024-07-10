
const asignar = document.querySelectorAll('.asignar');
const rechazar = document.querySelectorAll('.rechazar');
const btn_modal = document.querySelectorAll('.btn-modal');

asignar.forEach(elemento => {
    elemento.addEventListener('click', asignarRepartidor);
});

rechazar.forEach(elemento => {
    elemento.addEventListener('click', rechazarRepartidor);
});

btn_modal.forEach(elemento => {
    elemento.addEventListener('click', cargarModal);
});


function asignarRepartidor(e){ 
    const bnt = e.target;
    const repartidor = document.getElementById('repartidor'+bnt.getAttribute('data-envio-id'));
    const data = {id_repartidor: repartidor.value, id_envio: bnt.getAttribute('data-envio-id')};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`${URL_WEB}envio-resultado/asignar`, {
        method: 'POST',
        body: JSON.stringify(data),
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
                text: "Asignado correctamente!",
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

function rechazarRepartidor(e){
    const btn = e.target;
    const data = {id_envio: btn.getAttribute('data-envio-id')};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`${URL_WEB}envio-resultado/rechazar`, {
        method: 'POST',
        body: JSON.stringify(data),
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
                title: "Hecho!",
                text: "Rechazado correctamente!",
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

function cargarModal(e){
    const btn = e.target.closest('button');
    console.log(btn);
    const data = {id_envio: btn.getAttribute('data-envio-id')};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`${URL_WEB}envio-resultado/informe`, {
        method: 'POST',
        body: JSON.stringify(data),
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
        
            datos = data.data;
            const numero_examen = document.getElementById('numero-examen');
            //const paciente = document.getElementById('paciente');
            const informe = document.getElementById('informe');
            const ubicacion = document.getElementById('ubicacion');
            const conclusiones = document.getElementById('conclusiones');
            const fecha = document.getElementById('fecha');
            const recomendaciones = document.getElementById('recomendaciones');

            numero_examen.value = datos.id;
            recomendaciones.textContent = datos.recomendacion;
            fecha.value = datos.fecha;
            conclusiones.textContent = datos.conclusion;
            informe.textContent = datos.informe;
            ubicacion.value = data.ubicacion;
    
    })
    .catch(error => console.error('Error de la solicitud', error));
}