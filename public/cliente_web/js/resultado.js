const formatAction = (element) => {
    return `
    <a href="${URL_WEB}resultado-comprobante/${element.id}" target="_blank" title="Comprobante resultado" data-id="${element.id}" class="btn btn-sm btn-primary note my-1"><i class="bi bi-file-earmark-pdf"></i></a>
    <a href="${URL_WEB}cliente-resultado-confirmar-envio/${element.id}" title="Pedir resultado en casa" data-id="${element.id}" class="btn btn-sm btn-success note my-1"><i class="bi bi-geo-alt"></i></a>`;
};

const formatActionRestore = (element) => {
    return `
    <button data-id="${element.id}" class="btn btn-sm btn-info restore"><i class="fa fa-undo"></i> Restaurar</button>`;
};

const apiClient = new ApiClient(URL_API_REST);
const config = {
    table: $("#table"),
    // tableDeletes: $("#table-delete"),
    // loaderObject: loader,
    // modalEdit: "modal_edit",
    // saveBtn: "save",
    // updateBtn: "update",
    // editShowBtn: ".edit",
    // deleteBtn: ".delete",
    // restoreBtn: ".restore",
    // labelPrefixEdit: "_edit",
    selectors: [
        "id",
        "informe",
        "conclusion",
        "recomendacion",
        "fecha",
        "examen_id",
    ],
    loadRelations: true,
    relations: [
        {
            name: "examenes",
            nameSecondary: "examen",
            nameIndex: ["id"],
            selectId: "examen_id",
        },
    ],
    ImageContent: {
        loadImage: true,
        nameIndex: "imagen_index",
        namePreview: "imagen_preview",
        fieldName: "imagen_1",
        stylesImage: {
            width: "100px",
            height: "100px",
            borderRadius: "10px",
        },
    },
    formatAction: formatAction,
    formatActionRestore: formatActionRestore,
};

// pacienteId viene de resultado.blade.php
const crudHandler = new CrudHandler(apiClient, `resultado/paciente/${pacienteId}`, config);

document.addEventListener("DOMContentLoaded", () => {
    crudHandler.init();
    $(".dropify").dropify();
});

function mostrarVistaPrevia() {
    const inputImagen = document.getElementById("imagen");
    const vistaPrevia = document.getElementById("vista-previa");

    const archivo = inputImagen.files[0];

    if (archivo) {
        const lector = new FileReader();

        lector.onload = function (e) {
            vistaPrevia.src = e.target.result;
            vistaPrevia.style.display = "block";
        };

        lector.readAsDataURL(archivo);
    } else {
        vistaPrevia.style.display = "none";
        vistaPrevia.src = "";
    }
}
