

const formatAction = (element) => {
    return `
    <button data-id="${element.id}" class="btn btn-sm btn-warning edit"><i class="bi bi-pencil-fill"></i>Editar</button>
    <button data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i>Eliminar</button>`;
};

const formatActionRestore = (element) => {
    return `
    <button data-id="${element.id}" class="btn btn-sm btn-info restore"><i class="fa fa-undo"></i>Restaurar</button>`;
};

const apiClient = new ApiClient(URL_API_REST);
const config = {
    table: $("#table"),
    tableDeletes: $("#table-delete"),
    // loaderObject: loader,
    modalEdit: "modal_edit",
    saveBtn: "save",
    updateBtn: "update",
    editShowBtn: ".edit",
    deleteBtn: ".delete",
    restoreBtn: ".restore",
    labelPrefixEdit: "_edit",
    selectors: [
        "id",
        "nombre",
        "latitud",
        "longitud",
        "referencia",
        "resultado_id",
    ],
    loadRelations: false,
    formatAction: formatAction,
    formatActionRestore: formatActionRestore,
};

const crudHandler = new CrudHandler(apiClient, `envio/paciente/${pacienteId}`, config);

document.addEventListener("DOMContentLoaded", () => {
    crudHandler.init();
});