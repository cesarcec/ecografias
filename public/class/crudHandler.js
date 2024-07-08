/**
 * Clase que gestiona las operaciones CRUD para una entidad específica.
 */
class CrudHandler {
    /**
     * Constructor de la clase CrudHandler.
     * @param {ApiClient} apiClient - Objeto para realizar solicitudes HTTP.
     * @param {string} entity - Nombre de la entidad a manejar.
     * @param {Object} config - Configuración para la clase.
     * @param {MessageHandler} messageHandler - Manejador de mensajes.
     */
    constructor(apiClient, entity, config, messageHandler) {
        this.apiClient = apiClient;
        this.entity = entity;
        this.config = config;
        this.dataIndex = [];
        this.dataDisabled = [];
        this.dataRelations = [];
        this.dataCart = [];
        this.id = 0;
        this.messageHandler = messageHandler;
    }

    /**
     * Inicializa la clase, agregando listeners y cargando datos iniciales.
     */
    async init() {
        try {
            this.initTable();
            this.showLoader();
            await this.loadData();
            await this.loadDataDelete();
            this.hideLoader();
            this.addEventListeners();
        } catch (error) {
            console.log(error);
            this.hideLoader();
        }
    }

    /* /// Métodos de manejo de eventos /// */

    /**
     * Agrega listeners a los elementos que coinciden con el selector dado.
     * @param {string} selector - Selector de los elementos a los que se les agregará el listener.
     * @param {function} callback - Función a ejecutar cuando se activa el evento.
     * @param {string} event - Tipo de evento a escuchar (por defecto, "click").
     */
    addEventListeners() {
        this.addButtonListener(this.config.saveBtn, () => this.postInsert());
        this.addButtonListener(this.config.updateBtn, () =>
            this.putUpdateId(this)
        );
        this.addButtonListener(this.config.showModalTemporaryBtn, () =>
            this.openModal(this.config.modalTemporary)
        );
        this.addButtonListener(this.config.addItemBtn, () =>
            this.addItemTemporary()
        );
        this.addButtonListener(this.config.saveTemporaryBtn, () =>
            this.saveCart()
        );
        this.addButtonListener(this.config.updateTemporaryBtn, () =>
            this.updateCart()
        );
        this.addButtonListenerClass(this.config.editShowBtn, this.loadDataEdit);
        this.addButtonListenerClass(
            this.config.addCartBtn,
            this.addItemTemporary
        );
        this.addButtonListenerClass(this.config.deleteBtn, (button, self) =>
            this.showConfirmation("delete", self)
        );
        this.addButtonListenerClass(this.config.restoreBtn, (button, self) =>
            this.showConfirmation("restore", self)
        );
    }

    /**
     * Agrega un listener al botón especificado en la configuración.
     * @param {string} selector - Selector del botón al que se le agregará el listener.
     * @param {function} callback - Función a ejecutar cuando se activa el evento (por defecto, "click").
     * @param {string} event - Tipo de evento a escuchar (por defecto, "click").
     */
    addButtonListener(selector, callback, event = "click") {
        const element = document.getElementById(selector);
        if (!element) {
            return;
        }
        element.addEventListener(event, () => {
            callback();
        });
    }

    addButtonListenerClass(selector, callback, event = "click") {
        const buttons = document.querySelectorAll(selector) ?? [];
        const self = this;
        buttons.forEach((button) => {
            button.addEventListener(event, () => {
                this.id = button.getAttribute("data-id");
                callback(button, self);
            });
        });
    }

    showConfirmation(type, self) {
        try {
            const { title, text, buttonText, callback } =
                self.confirmationConfig(self)[type];
            self.alertConfirm(title, text, "warning", buttonText, () =>
                callback(self)
            );
        } catch (error) {
            console.log(error);
        }
    }

    confirmationConfig(self) {
        return {
            delete: {
                title: "Eliminar",
                text: "¿Seguro de eliminar el registro?",
                buttonText: "Eliminar",
                callback: self.putDestroyId,
            },
            restore: {
                title: "Restaurar",
                text: "¿Seguro de restaurar el registro?",
                buttonText: "Restaurar",
                callback: self.putRestoreId,
            },
        };
    }

    /* /// Métodos HTTP /// */

    /**
     * Realiza una inserción mediante una solicitud POST.
     * @param {Object} dataClient - Datos a enviar en la solicitud.
     * @param {string} apiMethod - Método de la API para la operación.
     */
    async postInsert(dataClient = undefined, apiMethod = "store") {
        dataClient = dataClient ?? this.assembleObject();
        let result = true;

        if (this.config.validatePassword) {
            if (!this.validatePassword()) {
                return;
            }
        }

        this.showLoader();

        try {
            const response = await this.apiClient.post(
                `${this.entity}/${apiMethod}`,
                dataClient
            );
    
            this.hideLoader();
    
            if (response.status == 200 || response.status == 201) {
                this.handleSuccessResponseInsert(response);
            } else {
                this.showAlert("error", "Ocurrió un problema", 1500);
                result = false;
            }
        } catch (error) {
            this.showAlert("error", "Ocurrió un problema", 1500);
            console.error(error);
            result = false;
        }
        return result;
    }

    async perfomApiResquest({
        method = "put",
        apiMethod = "destroy",
        id = 0,
        successCallback,
        dataClient = undefined,
    } = {}) {
        this.showLoader();

        try {
            const prefixEdit = this.config.labelPrefixEdit ?? "";
            dataClient =
                dataClient ??
                this.assembleObject(method.toUpperCase(), prefixEdit);
            const response = await this.apiClient[method](
                `${this.entity}/${apiMethod}/${id}`,
                dataClient
            );

            this.hideLoader();

            if (response.status == 200) {
                successCallback(response);
            } else {
                this.showAlert("error", "Ocurrió un problema", 1500);
            }
        } catch (error) {
            console.log(error);
        }
    }

    async putUpdateId() {
        try {
            await this.perfomApiResquest({
                method: "put",
                apiMethod: "update",
                id: this.id,
                successCallback: (response) =>
                    this.handleSuccessResponseUpdate(response),
            });
        } catch (error) {
            console.error(error);
        }
    }

    async putDestroyId(self) {
        try {
            await self.perfomApiResquest({
                method: "put",
                apiMethod: "destroy",
                id: self.id,
                successCallback: (response) =>
                    self.handleSuccessResponseDestroy(response),
            });
        } catch (error) {}
    }

    async putRestoreId(self) {
        try {
            await self.perfomApiResquest({
                method: "put",
                apiMethod: "restore",
                id: self.id,
                successCallback: (response) =>
                    self.handleSuccessResponseRestore(response),
            });
        } catch (error) {}
    }

    /* /// Métodos de manipulación de datos /// */

    /**
     * Ensambla un objeto a partir de datos del formulario.
     * @param {string} method - Método HTTP para el objeto (por defecto, POST).
     * @returns {FormData} - Objeto FormData con los datos del formulario.
     */
    assembleObject(method = "POST", label = "") {
        const formData = new FormData();
        formData.append("_method", method);

        this.config.selectors.forEach((element) => {
            const input = document.getElementById(`${element}${label}`);
            if (!input) {
                return;
            }
            if (input.type == "file" || input.type == "image") {
                formData.append(element, input.files[0]);
                return;
            }

            formData.append(element, input.value);
        });

        const cartRelation = this.config.cartRelation ?? "relationNot";
        formData.append(cartRelation, JSON.stringify(this.dataCart));

        return formData;
    }

    /**
     * Carga datos desde la API y actualiza la tabla correspondiente.
     */

    async loadData() {
        this.dataIndex = await this.loadDataCommon("", this.dataIndex, true);
        console.log(this.dataIndex);
        this.loadSelectRelations();
        this.refreshTableIndex();
        this.loadInputEditNewPage();
        this.loadTableTemporaryNewPage();
        this.loadDataTemporary();
    }

    async loadDataCommon(endpoint, targetData, reloadRelations = false) {
        const response = await this.apiClient.get(`${this.entity}/${endpoint}`);
        targetData = response.data;

        if (this.config.loadRelations) {
            this.castObjectIndex(targetData);
        }

        if (reloadRelations) {
            this.dataRelations = response.relations ?? [];
        }

        return targetData;
    }

    loadDataTemporary() {
        if (!this.config.loadRelations) {
            return;
        }
        const relationObject = this.config.relations;
        const nameRelation = relationObject[0].name;
        const nameRecursive = relationObject[0].nameRecursive;

        if (this.config.loadDataCartTemporary) {
            this.dataCart = this.dataIndex[nameRecursive] ?? [];
        }

        this.loadTableCart(this.dataRelations[nameRelation]);
    }

    async loadDataDelete(endpoint = "disabled") {
        if (this.config.loadDisabled === false) {
            return;
        }
        this.dataDisabled = await this.loadDataCommon(
            endpoint,
            this.dataDisabled
        );
        this.refreshTableDeletes();
    }

    loadInputEditNewPage() {
        if (!this.config.newPageEdit /*|| !this.config.isIndex*/) {
            return;
        }
        const selectors = this.config.selectors;
        const data = this.dataIndex;
        for (const index in selectors) {
            const selector = selectors[index];
            const input = document.getElementById(selector);
            input.value = data[selector] ?? "";
        }
    }

    loadTableTemporaryNewPage() {
        if (!this.config.newPageEdit) {
            return;
        }
        try {
            const relation = this.config.relations[0];
            const dataManyRelation = this.dataIndex[relation.name] ?? [];
            this.dataCart = dataManyRelation;
            this.updateTemporaryTable();
        } catch (error) {}
    }

    /**
     * Aplica casting a cada objeto en el array principal, agregando propiedades
     * adicionales con datos de relaciones.
     * @param {Array} data - Array de objetos al que se le aplicará el casting.
     */
    castObjectIndex(data) {
        if (!this.config.loadRelations) {
            return;
        }
        if (!Array.isArray(data)) {
            return;
        }
        data.forEach((element) => {
            this.castObject(element);
        });
    }

    /**
     * Aplica casting a un objeto para mostrar sus relaciones.
     * @param {Object} data - Objeto al que se le aplicará el casting.
     */
    castObject(data) {
        if (!this.config.relations) {
            return;
        }
        const relations = this.config.relations;
        relations.forEach((element) => {
            const nameRelation = element.nameSecondary;
            const dataSecondary = data[nameRelation];
            const nameIndex = element.nameIndex;

            if (!dataSecondary) {
                return;
            }

            for (const index in nameIndex) {
                const nameRelationIndex = nameIndex[index];
                const nameInData = `${nameRelation}_${nameRelationIndex}`;
                data[nameInData] = dataSecondary[nameRelationIndex];
            }
        });
    }

    /**
     * Función de dialog
     */

    /* /// Métodos de manipulación da manipulación del DOM /// */

    /**
     * Inicializa las tablas utilizando Bootstrap Table.
     */
    initTable() {
        try {
            this.config.table.bootstrapTable();
            this.config.tableDeletes.bootstrapTable();
        } catch (error) {}
    }

    refreshTableDeletes() {
        if (!this.config.tableDeletes) {
            return;
        }
        this.orderBy(this.dataDisabled);
        this.addActionObjects(this.dataDisabled, "formatActionRestore");
        this.loadImageIndex(this.dataDisabled);
        this.config.tableDeletes.bootstrapTable("load", this.dataDisabled);
        this.addButtonListenerClass(this.config.restoreBtn, () => {
            //title, text, icon, textButton, callback
            this.alertConfirm(
                "Restaurar",
                "¿Seguro de restaurar el registro?",
                "warning",
                "Restaurar",
                this.putRestoreId
            );
        });
    }

    refreshTableIndex() {
        if (!this.config.table) {
            return;
        }
        this.orderBy(this.dataIndex);
        this.addActionObjects(this.dataIndex);
        this.loadImageIndex(this.dataIndex);
        this.config.table.bootstrapTable("load", this.dataIndex);
        this.addButtonListenerClass(this.config.editShowBtn, this.loadDataEdit);
        this.addButtonListenerClass(this.config.deleteBtn, () => {
            //title, text, icon, textButton, callback
            this.alertConfirm(
                "Eliminar",
                "¿Seguro de eliminar el registro?",
                "warning",
                "Eliminar",
                this.putDestroyId
            );
        });
    }

    /**
     * Agrega la propiedad 'action' a cada objeto en el array.
     * @param {Array} data - Array de objetos al que se le agregarán las acciones.
     * @param {string} method - Método a utilizar para formatear las acciones.
     */
    addActionObjects(data, method = "formatAction") {
        data.forEach((element) => {
            element.action = this.config[method](element);
        });
    }

    addActionObject(element, method = "formatAction") {
        element.action = this.config[method](element);
    }

    /**
     * Carga las relaciones en los selectores especificados en la configuración.
     */
    loadSelectRelations() {
        if (!this.config.loadRelations) {
            return;
        }

        const relations = this.config.relations ?? [];
        relations.forEach((element) => {
            const prefixEdit = this.config.labelPrefixEdit ?? "";
            const select = document.getElementById(element.selectId);
            const selectEdit = document.getElementById(
                `${element.selectId}${prefixEdit}`
            );
            const data = this.dataRelations[element.name];
            const names = element.nameIndex;
            this.loadSelect({ data, select, names });
            this.loadSelect({ data, select: selectEdit, names});
        });
    }

    /**
     * Carga datos en un elemento select del formulario.
     * @param {Array} data - Datos a cargar en el select.
     * @param {HTMLSelectElement} select - Elemento select del formulario.
     * @param {number} id - ID preseleccionado en el select.
     */
    loadSelect({ data, select, id = 0, names = [] }) {
        if (!select || !data) {
            return;
        }
       try {
            select.innerHTML = "";
            /* const optionElementFirst= document.createElement("option");
            optionElementFirst.value = null;
            optionElementFirst.text = "Seleccione una opción";
            select.add(optionElementFirst); */
            data.forEach((element) => {
                const optionElement = document.createElement("option");
                optionElement.value = element.id;
                let nameIndexSelect = element.name;
                if (!element.name) {
                    nameIndexSelect = this.concatNamesSelect(element, names);
                }

                optionElement.text = `${element.id} - ${nameIndexSelect}`;

                if (element.id == id) {
                    optionElement.selected = true;
                }

                select.add(optionElement);
            });
       } catch (error) {
        
       }
    }

    concatNamesSelect(element, names) {
        let string = "";
        for (let i = 0; i < names.length && i < 2; i++) {
            const name = names[i];
            string += element[name] + " ";
        }
        return string;
    }

    /**
     * Carga datos en un elemento select del formulario.
     * @param {HTMLSelectElement} target - Elemento presionado del formulario.
     * @param {self} self - Referencia a la misma clase.
     */
    loadDataEdit(target, self) {
        const id = target.getAttribute("data-id");

        if (self.config.newPageEdit) {
            localStorage.setItem("dataId", id);
            self.hrefPage(`${self.entity}/${id}`);
            return;
        }

        const dataEdit = self.dataIndex.find((element) => element.id == id);
        const prefix = self.config.labelPrefixEdit ?? "";
        self.loadDataEditValue(dataEdit, self, prefix);
        self.openModal(self.config.modalEdit);

        const buttonUpdate = document.getElementById(self.config.updateBtn);
        buttonUpdate.setAttribute("data-id", id);
    }

    loadDataEditValue(data, self, label = "") {
        const selectors = self.config.selectors;
        for (const key in selectors) {
            const selector = selectors[key];
            const input = document.getElementById(`${selector}${label}`);
            // if (!input) {
            //     break;
            // }
            if (input && (input.type == "file" || input.type == "image")) {
            } else if (input) {
                input.value = data[selector];
            }
        }
    }

    /* /// Métodos de alertas y mensajes /// */

    /**
     * Muestra una alerta utilizando la librería Swal (SweetAlert).
     * @param {string} icon - Icono a mostrar en la alerta (success, error, etc.).
     * @param {string} title - Título de la alerta.
     * @param {number} timer - Duración en milisegundos antes de cerrar automáticamente.
     */
    showAlert(icon, title, timer) {
        Swal.fire({
            position: "center",
            icon: icon,
            title: title,
            showConfirmButton: false,
            timer: timer,
        });
    }

    /**
     * Muestra un mensaje de confirmación utilizando la librería Swal (SweetAlert).
     * @param {string} title - Título del mensaje de confirmación.
     * @param {string} text - Texto del mensaje de confirmación.
     * @param {string} icon - Icono a mostrar en la alerta (success, error, etc.).
     * @param {string} textButton - Texto del botón de confirmación.
     * @param {function} callback - Función a ejecutar si se confirma el mensaje.
     */
    alertConfirm(title, text, icon, textButton, callback) {
        const self = this;
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: textButton,
        }).then((result) => {
            if (result.isConfirmed) {
                callback(self);
            }
        });
    }

    /* /// Acciones y alertas luego de realizar una operación http /// */

    handleSuccessResponseInsert(response) {
        const dataResponse = response.data;
        this.castObject(dataResponse);
        this.dataIndex.push(dataResponse);
        this.refreshTableIndex();
        this.cleanInput();
        this.showAlert("success", "Guardado exitosamente", 1500);
    }

    handleSuccessResponseUpdate(
        response,
        message = "Registro Actualizado exitosamente"
    ) {
        const dataResponse = response.data;
        const dataUpdate = this.dataIndex.find(
            (element) => element.id == dataResponse.id
        );
        this.copyProperties(dataUpdate, dataResponse);
        this.castObject(dataUpdate);
        this.refreshTableIndex();
        const prefixEdit = "_edit";
        this.cleanInput(prefixEdit);
        this.closeModal(this.config.modalEdit);
        this.showAlert("success", message, 1500);
    }

    handleSuccessResponseDestroy(
        response,
        message = "Registro eliminado exitosamente"
    ) {
        const dataResponse = response.data;
        const dataDestroy = this.findElementByCondition(
            this.dataIndex,
            (element) => element.id == dataResponse.id
        );
        this.dataIndex = this.filterArrayById(this.dataIndex, dataResponse.id);
        this.copyProperties(dataDestroy, dataResponse);
        this.castObject(dataDestroy);
        this.dataDisabled.push(dataDestroy);
        this.refreshTableIndex();
        this.refreshTableDeletes();
        this.showAlert("success", message, 1500);
    }

    handleSuccessResponseRestore(
        response,
        message = "Registro restaurado exitosamente"
    ) {
        const dataResponse = response.data;
        const dataRestore = this.findElementByCondition(
            this.dataDisabled,
            (element) => element.id == dataResponse.id
        );
        this.dataDisabled = this.filterArrayById(
            this.dataDisabled,
            dataResponse.id
        );
        this.copyProperties(dataRestore, dataResponse);
        this.castObject(dataRestore);
        this.dataIndex.push(dataRestore);
        this.refreshTableIndex();
        this.refreshTableDeletes();
        this.showAlert("success", message, 1500);
    }

    /*Métodos para 3ras tablas */

    loadTableCart(data) {
        if (!this.config.tableCartRelation) {
            return;
        }
        const table = this.config.tableCartRelation;
        this.loadFormatActionsCart(data);
        table.bootstrapTable();
        table.bootstrapTable("load", data);
        this.loadTableTemporary();
    }

    loadTableTemporary() {
        if (this.config.tableCartTemporary == undefined) {
            return;
        }
        this.loadFormatActionsCart(this.dataCart, "temporal");
        const table = this.config.tableCartTemporary;
        table.bootstrapTable();
        table.bootstrapTable("load", this.dataCart);
    }

    loadFormatActionsCart(data, functionAction = "relation") {
        switch (functionAction) {
            case "relation":
                data.forEach((element) => {
                    element.action = this.config.formatActionsRelation(element);
                });
                break;
            case "temporal":
                data.forEach((element) => {
                    element.action =
                        this.config.formatActionsTemporary(element).action;
                });
                break;
            default:
                data.forEach((element) => {
                    element.action =
                        this.config.formatActionsTemporary(element).action;
                });
                break;
        }
    }

    findCartItemById = (data, id) => {
        return data.find((element) => element.id == id);
    };

    incrementCartItemAmount = (cartItem) => {
        cartItem.amount++;
        this.updateTemporaryTable(this.dataCart);
    };

    addNewCartItem = (id) => {
        const dataNameRelation = this.config.relations[0].name;
        const data = this.dataRelations[dataNameRelation];
        const dataAdd = data.find((element) => element.id == id);

        if (dataAdd) {
            dataAdd.amount = 1;
            this.dataCart.push(dataAdd);
            this.updateTemporaryTable(this.dataCart);
        }
    };

    addItemTemporary = (button = null, self = this) => {
        let id = 0;
        if (button == null) {
            const selectLabel = self.config.relations[0].selectId;
            const select = document.getElementById(selectLabel);
            id = select.value;
        } else {
            id = button.getAttribute("data-id");
        }

        const existingCartItem = self.findCartItemById(self.dataCart, id);

        if (existingCartItem) {
            self.incrementCartItemAmount(existingCartItem);
        } else {
            self.addNewCartItem(id);
        }

        self.showAlert("success", "Agregado correctamente", 400);
        self.closeModal(self.config.modalTemporary);
    };

    validateAndShowAlert = (value) => {
        let result = true;
        if (value <= 0) {
            this.showAlert(
                "error",
                "No se permiten valores menores o iguales a 0",
                1500
            );
            result = false;
        }
        return result;
    };

    updateAmount(event) {
        const input = event.target;
        const id = input.getAttribute("data-id");
        const minValue = 1;
        let newAmount = parseInt(input.value);

        if (!this.validateAndShowAlert(newAmount)) {
            input.value = minValue;
            newAmount = minValue;
        }

        const dataAmount = this.dataCart.find((element) => element.id == id);
        dataAmount.amount = newAmount;
    }

    addFormatActionsTemporary(data) {
        data.forEach((element) => {
            element.action = this.config.formatActionsTemporary(element).action;
            element.amount_input =
                this.config.formatActionsTemporary(element).amount_input;
        });
    }

    deleteCart(target, self = this) {
        const id = target.getAttribute("data-id");
        self.dataCart = self.dataCart.filter((element) => element.id != id);
        self.updateTemporaryTable();
    }

    updateTemporaryTable(data = this.dataCart) {
        if (!this.config.tableCartTemporary) {
            return;
        }

        this.addFormatActionsTemporary(data);

        this.config.tableCartTemporary.bootstrapTable("load", data);
        this.addButtonListenerClass(this.config.deleteCartBtn, this.deleteCart);
    }

    assembleObjectClientTemporary(method = "POST") {
        const dataClientForm = this.assembleObject(method);
        const cartRelation = this.config.cartRelation;
        dataClientForm.append(cartRelation, JSON.stringify(this.dataCart));
        return dataClientForm;
    }

    async saveCart(method = "store") {
        try {
            const entityHandler = this.config.entityHandler ?? this.entity;
            const url = `${entityHandler}/${method}`;
            const data = this.assembleObjectClientTemporary();
            this.showLoader();
            const response = await this.apiClient.post(url, data);
            this.hideLoader();

            if (response.status == 200) {
                this.showAlert(
                    "success",
                    "Registro insertado correctamente",
                    1000
                );
                setTimeout(() => {
                    this.hrefPage(entityHandler);
                }, 1100);
            } else {
                this.showAlert("error", "Error al insertar el registro", 1500);
            }
        } catch (error) {
            console.log(error);
        }
    }

    async updateCart(method = "update") {
        try {
            const entityHandler = this.config.entityHandler ?? this.entity;
            const id = this.dataIndex.id;
            const url = `${entityHandler}/${method}/${id}`;
            const data = this.assembleObjectClientTemporary("PUT");

            this.showLoader();
            const response = await this.apiClient.put(url, data);
            this.hideLoader();

            if (response.status == 200) {
                this.showAlert(
                    "success",
                    "Registro actualizado correctamente",
                    1000
                );
                setTimeout(() => {
                    this.hrefPage(entityHandler);
                }, 1100);
            } else {
                this.showAlert(
                    "error",
                    "Error al actualizar el registro",
                    1500
                );
            }
        } catch (error) {
            console.log(error);
            this.hideLoader();
        }
    }

    /* /// Métodos extras /// */

    copyProperties(objectOrigin, objecdestination) {
        for (const property in objecdestination) {
            objectOrigin[property] = objecdestination[property];
        }
    }

    openModal(modal) {
        $(`#${modal}`).modal("show");
    }

    closeModal(modal) {
        $(`#${modal}`).modal("hide");
    }

    cleanInput(label = "") {
        const selectors = this.config.selectors;
        selectors.forEach((element) => {
            const input = document.getElementById(`${element}${label}`) ?? {};
            if (input.tagName !== "SELECT") {
                input.value = "";
            }
        });

        this.cleanTableTemporary();
    }

    cleanTableTemporary(table = this.config.tableCartTemporary) {
        if (!table) {
            return;
        }
        this.dataCart = [];
        table.bootstrapTable("load", this.dataCart);
    }

    orderBy(data, order = "desc") {
        const sortOrder = order.toLowerCase() === "asc" ? 1 : -1;
        data.sort(
            (elementoA, elementoB) => (elementoA.id - elementoB.id) * sortOrder
        );
    }

    filterArrayById(array, id) {
        return array.filter((element) => element.id !== id);
    }

    findElementByCondition(array, condition) {
        return array.find(condition);
    }

    showLoader() {
        if (!this.config.loaderObject) {
            return;
        }
        const loader = this.config.loaderObject;
        loader.show();
    }

    hideLoader() {
        if (!this.config.loaderObject) {
            return;
        }
        const loader = this.config.loaderObject;
        loader.hide();
    }

    hrefPage(endpoint, urlWeb = URL_WEB) {
        const newLink = document.createElement("a");
        newLink.href = `${urlWeb}${endpoint}`;
        newLink.click();
    }

    loadImageIndex(data) {
        if (!Array.isArray(data)) {
            return;
        }
        if (!this.config.ImageContent || !this.config.ImageContent.loadImage) {
            return;
        }
        const fieldName = this.config.ImageContent.fieldName ?? "imagen";
        const nameIndex = this.config.ImageContent.nameIndex ?? "imagen_index";
        const styles = this.config.ImageContent.stylesImage;
        data.forEach((element) => {
            const figureElement = document.createElement("figure");
            const imageElement = document.createElement("img");
            imageElement.src = `${URL_WEB}assets/img/resultado/${element[fieldName]}`;
            figureElement.appendChild(imageElement);

            for (const property in styles) {
                if (Object.hasOwnProperty.call(styles, property)) {
                    const styleProperty = styles[property];
                    imageElement.style[property] = styleProperty;
                }
            }

            element[nameIndex] = figureElement.outerHTML;
        });
    }

    validatePassword() {
        const password = document.getElementById("password");
        const passwordConfirmation = document.getElementById(
            "password_confirmation"
        );

        let result = true;
        
        if (password.value != passwordConfirmation.value) {
            result = false;
            password.classList.add(this.config.classErrorInput);
            passwordConfirmation.classList.add(this.config.classErrorInput);
        } else {
            password.classList.remove(this.config.classErrorInput);
            passwordConfirmation.classList.remove(this.config.classErrorInput);
        }
        return result;
    }

    validateEmptyFields(inputIds) {
        let hasError = false;

        inputIds.forEach((id) => {
            const input = document.getElementById(id);
            if (!input.value.trim()) {
                input.classList.add(config.classErrorInput);
                hasError = true;
            } else {
                input.classList.remove(config.classErrorInput);
            }
        });

        return hasError;
    }
}
